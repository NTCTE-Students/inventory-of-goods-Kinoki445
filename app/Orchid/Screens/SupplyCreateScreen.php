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

class SupplyCreateScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'supply' => new Supply(),
        ];
    }

    public function name(): ?string
    {
        return 'Создание товара';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Создать товар')
                ->icon('bs.save')
                ->method('createSupply'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
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

    public function createSupply(Request $request)
    {
        $supply = new Supply();
        $supply->name = $request->input('supply.name');
        $supply->description = $request->input('supply.description');
        $supply->price = $request->input('supply.price');
        $supply->amount = $request->input('supply.amount');
        $supply->save();

        Toast::success('Товар создан');

        return redirect()->route('platform.supplies');
    }
}
