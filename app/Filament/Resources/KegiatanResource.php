<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kegiatan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\FileUpload;   
use App\Filament\Resources\KegiatanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KegiatanResource\RelationManagers;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kegiatan')
            ->required()
            ->label('Nama Kegiatan'),
        Forms\Components\Textarea::make('deskripsi')
            ->required()
            ->label('Deskripsi'),
        Forms\Components\TextInput::make('lokasi')
            ->required()
            ->label('Lokasi'),
        Forms\Components\DateTimePicker::make('waktu')
            ->required()
            ->label('Waktu Kegiatan'),
        Forms\Components\Select::make('hari')
            ->options([
                'Senin' => 'Senin',
                'Selasa' => 'Selasa',
                'Rabu' => 'Rabu',
                'Kamis' => 'Kamis',
                'Jumat' => 'Jumat',
                'Sabtu' => 'Sabtu',
                'Minggu' => 'Minggu',
               
            ])
            ->required()
            ->label('Hari'),

             // FileUpload untuk banner gambar kegiatan
        Forms\Components\FileUpload::make('banner_image')
        ->image()
        ->disk('public')
        ->directory('kegiatan_banners') // Menyimpan di folder kegiatan_banners
        ->label('Banner Gambar')
        ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->sortable()
                    ->searchable()
                    ->label('Nama Kegiatan'),
                Tables\Columns\TextColumn::make('lokasi')
                    ->sortable()
                    ->label('Lokasi'),
                Tables\Columns\TextColumn::make('hari')
                    ->sortable()
                    ->label('Hari'),
                Tables\Columns\TextColumn::make('waktu')
                    ->sortable()
                    ->label('Waktu Kegiatan')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('d-m-Y H:i') : '-'),
                    
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
            'index' => Pages\ListKegiatans::route('/'),
            'create' => Pages\CreateKegiatan::route('/create'),
            'edit' => Pages\EditKegiatan::route('/{record}/edit'),
        ];
    }
}
