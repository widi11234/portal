<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ionizer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\IonizerDetail;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\IonizerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Card as InfolistCard;
use App\Filament\Resources\IonizerResource\RelationManagers;
use App\Filament\Resources\IonizerResource\RelationManagers\IonizerDetailRelationManager;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class IonizerResource extends Resource
{
    protected static ?string $model = Ionizer::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationGroup = 'Data master';

    protected static ?string $recordTitleAttribute = 'register_no';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('register_no')->required()->unique(ignorable:fn($record)=>$record),
                    TextInput::make('area')->required(),
                    TextInput::make('location')->required()
                ])
                ->columns(2),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('register_no')->label('Register No'),
                    TextEntry::make('area')->label('Area'),
                    TextEntry::make('location')->label('Location'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('register_no')->sortable()->searchable(),
                TextColumn::make('area')->sortable()->searchable(),
                TextColumn::make('location')->sortable()->searchable(),
                TextColumn::make('qr_code')
                    ->label('QR Code')
                    ->html()
                    ->getStateUsing(function ($record) {
                        $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate($record->register_no));
                        return "<img src='data:image/svg+xml;base64,{$qrCode}' alt='QR Code' />";
                    }),
                TextColumn::make('related_count')
                    ->label('Measurement count')
                    ->badge()
                    ->color('primary')
                    ->getStateUsing(function ($record) {
                        return IonizerDetail::where('ionizer_id', $record->id)->count();
                    }),
                TextColumn::make('judgement_counts')
                    ->label('OK / NG Count')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        $counts = $record->judgement_counts ?? ['ok' => 0, 'ng' => 0];
                        return "OK: {$counts['ok']} | NG: {$counts['ng']}";
                    })
                    ->formatStateUsing(function ($state, $record) {
                        $counts = $record->judgement_counts ?? ['ok' => 0, 'ng' => 0];
                        return "<span style='color: green;'>OK: {$counts['ok']}</span> | <span style='color: red;'>NG: {$counts['ng']}</span>";
                    })
                    ->html(),
                TextColumn::make('created_at')->date()->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            IonizerDetailRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIonizers::route('/'),
            'create' => Pages\CreateIonizer::route('/create'),
            'view' => Pages\ViewIonizer::route('/{record}'),
            'edit' => Pages\EditIonizer::route('/{record}/edit'),
        ];
    }
}
