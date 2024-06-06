<?php

namespace App\Orchid\Screens;

use App\Models\Supply;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class SupplyEditScreen extends Screen
{
    public function query(Supply $supply): iterable
    {
        return [
            'supply' => $supply,
        ];
    }

    public function name(): ?string
    {
        return 'Редактирование товара';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Сохранить изменения')
                ->icon('bs.save')
                ->method('updateSupply'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('supply.id')->type('hidden'),
                Input::make('supply.name')
                    ->title('Название')
                    ->required(),
                TextArea::make('supply.description')
                    ->title('Описание')
                    ->required()
                    ->rows(5),
                Input::make('supply.price')
                    ->title('Цена (в копейках)')
                    ->required()
                    ->type('number'),
                Input::make('supply.amount')
                    ->title('Количество')
                    ->required()
                    ->type('number'),
            ])
        ];
    }

    public function updateSupply(Supply $supply, Request $request)
    {
        $supply->name = $request->input('supply.name');
        $supply->description = $request->input('supply.description');
        $supply->price = $request->input('supply.price');
        $supply->amount = $request->input('supply.amount');
        $supply->save();

        Toast::success('Товар обновлен');

        return redirect()->route('platform.supplies');
    }
}
