<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherItemResource\Pages;
use App\Models\VoucherItem;
use App\Models\Voucher;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VoucherItemResource extends Resource
{
    protected static ?string $model = VoucherItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Quản lý chương trình';
    protected static ?string $label = 'Mã voucher';
    protected static ?string $pluralLabel = 'Danh sách mã voucher';
    protected static ?string $navigationLabel = 'Mã voucher';
    protected static ?string $slug = 'voucher-items';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin mã voucher')
                    ->description('Quản lý từng mã voucher phát sinh từ chương trình')
                    ->schema([
                        Forms\Components\Select::make('voucher_id')
                            ->label('Thuộc voucher')
                            ->relationship('voucher', 'voucher_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('code')
                            ->label('Mã code')
                            ->placeholder('Nhập mã code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_used')
                            ->label('Đã sử dụng?'),
                        Forms\Components\DateTimePicker::make('used_at')
                            ->label('Thời gian sử dụng'),
                        Forms\Components\Select::make('customer_id')
                            ->label('Khách đã nhận')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('voucher.voucher_name')
                    ->label('Tên chương trình')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Mã code')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_used')
                    ->label('Đã sử dụng?')
                    ->boolean(),
                Tables\Columns\TextColumn::make('used_at')
                    ->label('Thời gian sử dụng')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Khách đã nhận')
                    ->searchable(),
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
                Tables\Filters\TernaryFilter::make('is_used')
                    ->label('Đã sử dụng?'),
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
            ->emptyStateHeading('Chưa có mã voucher nào')
            ->emptyStateDescription('Nhấn nút "Tạo mã voucher" để thêm mới.');
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
            'index' => Pages\ListVoucherItems::route('/'),
            'create' => Pages\CreateVoucherItem::route('/create'),
            'edit' => Pages\EditVoucherItem::route('/{record}/edit'),
        ];
    }
}
