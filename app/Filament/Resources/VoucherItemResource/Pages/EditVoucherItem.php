<?php

namespace App\Filament\Resources\VoucherItemResource\Pages;

use App\Filament\Resources\VoucherItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVoucherItem extends EditRecord
{
    protected static string $resource = VoucherItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
