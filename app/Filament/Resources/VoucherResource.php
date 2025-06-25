<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Models\Voucher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Quản lý chương trình';
    protected static ?string $label = 'Voucher';
    protected static ?string $pluralLabel = 'Danh sách voucher';
    protected static ?string $navigationLabel = 'Voucher';
    protected static ?string $slug = 'vouchers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin voucher')
                    ->description('Nhập thông tin chi tiết cho voucher')
                    ->schema([
                        Forms\Components\TextInput::make('voucher_name')
                            ->label('Tên voucher')
                            ->placeholder('Nhập tên voucher')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả')
                            ->placeholder('Nhập mô tả')
                            ->rows(2)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('chance')
                            ->label('Tỉ lệ trúng (%)')
                            ->placeholder('Nhập tỉ lệ trúng')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('voucher_name')
                    ->label('Tên voucher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Mô tả')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('chance')
                    ->label('Tỉ lệ trúng (%)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Có thể thêm filter nâng cao ở đây
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa nhiều'),
                ]),
            ])
            ->emptyStateHeading('Chưa có voucher nào')
            ->emptyStateDescription('Nhấn nút "Tạo voucher" để thêm mới voucher.');
    }

    public static function getRelations(): array
    {
        return [
            // Có thể thêm relation managers ở đây
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVouchers::route('/'),
            'create' => Pages\CreateVoucher::route('/create'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }
}
