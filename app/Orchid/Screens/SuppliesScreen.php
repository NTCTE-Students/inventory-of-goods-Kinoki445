<?php

namespace App\Orchid\Screens;

use App\Models\Supply;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class SuppliesScreen extends Screen
{
    public function query(): iterable
    {
        return ['supplies' => Supply::paginate(10)];
    }

    public function name(): ?string
    {
        return 'Товары';
    }

    public function commandBar(): array
    {
        return [
            Link::make('Создать товар')
                ->icon('bs.plus')
                ->route('platform.supply.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('supplies', [
                TD::make('id', 'ID')->sort()->filter(Input::make()),
                TD::make('name', 'Название')
                    ->sort()
                    ->filter(Input::make()),
                TD::make('description', 'Описание')->sort()->filter(Input::make()),
                TD::make('price', 'Цена')->sort()->filter(Input::make()),
                TD::make('amount', 'Количество')->sort()->filter(Input::make()),
                TD::make('actions', 'Действия')
                    ->render(function (Supply $supply) {
                        return implode(' ', [
                            Link::make('Редактировать')
                                ->icon('bs.pencil')
                                ->route('platform.supply.edit', $supply->id),
                            Button::make('Удалить')
                                ->icon('bs.trash')
                                ->method('deleteSupply')
                                ->parameters([
                                    'supply_id' => $supply->id,
                                ])
                                ->confirm('Вы уверены, что хотите удалить этот товар?'),
                        ]);
                    }),
            ]),
        ];
    }

    /**
     * Метод для редактирования товара.
     *
     * @param int $supply_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editSupply(int $supply_id)
    {
        return redirect()->route('platform.supply.edit', $supply_id);
    }

    public function deleteSupply(Request $request)
    {
        $supply_id = $request->input('supply_id');
        Supply::findOrFail($supply_id)->delete();

        Toast::success('Товар удален');

        return redirect()->route('platform.supplies');
    }
}
