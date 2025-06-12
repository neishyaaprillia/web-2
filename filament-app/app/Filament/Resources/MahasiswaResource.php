<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('nim')->searchable()->sortable(),
                TextColumn::make('jurusan')->searchable()->sortable(),
                TextColumn::make('jenis_kelamin')->searchable()->sortable(),
                TextColumn::make('agama')->searchable()->sortable(),
                TextColumn::make('status')->searchable()->sortable(),

            ])
            ->filters([
            //
            SelectFilter::make('agama')
            ->options([
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Hindu' => 'Hindu',
            ]),
            SelectFilter::make('jenis_kelamin')
            ->options([
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
            ]),
            SelectFilter::make('jurusan')
            ->options([
            'Teknik Informatika' => 'Teknik Informatika',
            'Sistem Informasi' => 'Sistem Informasi',
            'Teknik Elektro' => 'Teknik Elektro',
            ])
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
