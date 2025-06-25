<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmsLogResource\Pages;
use App\Filament\Resources\SmsLogResource\RelationManagers;
use App\Models\SmsLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SmsLogResource extends Resource
{
    protected static ?string $model = SmsLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Quản lý chương trình';
    protected static ?string $label = 'Lịch sử SMS';
    protected static ?string $pluralLabel = 'Lịch sử gửi SMS';
    protected static ?string $navigationLabel = 'Lịch sử SMS';
    protected static ?string $slug = 'sms-logs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin SMS')
                    ->description('Quản lý lịch sử gửi tin nhắn SMS')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->placeholder('Nhập số điện thoại')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('message')
                            ->label('Nội dung tin nhắn')
                            ->placeholder('Nhập nội dung SMS')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('status')
                            ->label('Trạng thái')
                            ->placeholder('Thành công/Lỗi')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('sent_at')
                            ->label('Thời gian gửi')
                            ->required(),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Ngày tạo bản ghi')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Nội dung SMS')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sent_at')
                    ->label('Thời gian gửi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo bản ghi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'thành công' => 'Thành công',
                        'lỗi' => 'Lỗi',
                    ]),
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
            ->emptyStateHeading('Chưa có lịch sử SMS nào')
            ->emptyStateDescription('Nhấn nút "Tạo SMS log" để thêm mới.');
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
            'index' => Pages\ListSmsLogs::route('/'),
            'create' => Pages\CreateSmsLog::route('/create'),
            'edit' => Pages\EditSmsLog::route('/{record}/edit'),
        ];
    }
}
