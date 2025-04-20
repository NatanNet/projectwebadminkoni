<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    // protected static ?string $navigationGroup = 'Admin';
    
    // protected static ?string $navigationLabel = 'Event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_event')
                ->required()
                ->label('Nama Event'),
            Forms\Components\Textarea::make('deskripsi')
                ->required()
                ->label('Deskripsi'),
            Forms\Components\TextInput::make('lokasi')
                ->required()
                ->label('Lokasi'),
            Forms\Components\DatePicker::make('tanggal_mulai')
                ->required()
                ->label('Tanggal Mulai Event'),
            Forms\Components\DatePicker::make('tanggal_selesai')
                ->required()
                ->label('Tanggal Selesai Event'),
                Forms\Components\FileUpload::make('banner_image') // Menambahkan FileUpload untuk gambar
                ->image() // Hanya menerima file gambar
                ->disk('public') // Menyimpan file di disk public
                ->directory('event_banners') // Menyimpan di folder `event_banners`
                ->label('Banner Gambar')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_event')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('lokasi')->sortable(),
                TextColumn::make('tanggal_mulai')
                ->sortable()
                ->label('Tanggal Mulai')
                ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d-m-Y') : '-'),
                TextColumn::make('tanggal_selesai')
                ->sortable()
                ->label('Tanggal Selesai')
                ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d-m-Y') : '-'),
                // Menampilkan gambar banner di tabel
                ImageColumn::make('banner_image') // Menampilkan gambar banner
                    ->label('Banner Gambar')
                    ->disk('public')
                    ->url(fn ($record) => Storage::url($record->banner_image)) // Menggunakan Storage untuk mendapatkan URL gambar
                    ->square() // Gambar ditampilkan dalam bentuk persegi
                    ->size(100), // Ukuran gambar
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
