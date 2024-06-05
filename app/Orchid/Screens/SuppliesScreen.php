<?php

namespace App\Orchid\Screens;

use App\Models\Supply;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class SuppliesScreen extends Screen
{
    /**
     * Получить данные для отображения на экране.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'supplies' => Supply::paginate(10),
        ];
    }

    /**
     * Название экрана, отображаемое в заголовке.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Товары';
    }

    /**
     * Кнопки действий экрана.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Создать товар')
                ->icon('bs.plus')
                ->route('platform.supply.create'),
        ];
    }

    /**
     * Элементы макета экрана.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('supplies', [
                TD::make('id', 'ID')
                    ->sort()
                    ->filter(Input::make()),

                TD::make('name', 'Название')
                    ->sort()
                    ->filter(Input::make())
                    ->render(function (Supply $supply) {
                        return Link::make($supply->name)
                            ->route('platform.supply.edit', $supply->id);
                    }),
                    
                TD::make('description', 'Описание')
                    ->sort()
                    ->filter(Input::make()),

                TD::make('price', 'Цена')
                    ->sort()
                    ->filter(Input::make()),

                TD::make('amount', 'Количество')
                    ->sort()
                    ->filter(Input::make()),

                // Добавьте другие столбцы по мере необходимости
            ]),
        ];
    }
}
