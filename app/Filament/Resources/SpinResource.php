<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpinResource\Pages;
use App\Models\Spin;
use App\Models\Customer;
use App\Models\VoucherItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SpinResource extends Resource
{
    protected static ?string $model = Spin::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?string $navigationGroup = 'Quản lý chương trình';
    protected static ?string $label = 'Lịch sử quay';
    protected static ?string $pluralLabel = 'Lịch sử quay';
    protected static ?string $navigationLabel = 'Lịch sử quay';
    protected static ?string $slug = 'spins';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin lượt quay')
                    ->description('Quản lý lịch sử quay của khách hàng')
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->label('Khách hàng')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('voucher_item_id')
                            ->label('Voucher trúng')
                            ->relationship('voucherItem', 'code')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\TextInput::make('result_text')
                            ->label('Kết quả')
                            ->placeholder('Nhập kết quả quay')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Thời gian quay')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('voucherItem.code')
                    ->label('Voucher trúng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('result_text')
                    ->label('Kết quả')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Thời gian quay')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
            ->emptyStateHeading('Chưa có lượt quay nào')
            ->emptyStateDescription('Nhấn nút "Tạo lượt quay" để thêm mới.');
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
            'index' => Pages\ListSpins::route('/'),
            'create' => Pages\CreateSpin::route('/create'),
            'edit' => Pages\EditSpin::route('/{record}/edit'),
        ];
    }
}
