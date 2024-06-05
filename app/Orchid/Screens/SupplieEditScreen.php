<?php

namespace App\Orchid\Screens;

use App\Models\Supply;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SupplieEditScreen extends Screen
{
    /**
     * Получить данные для отображения на экране.
     *
     * @param int|null $supply_id
     * @return array
     */
    public function query($supply_id = null): iterable
    {
        $supply = $supply_id ? Supply::findOrFail($supply_id) : new Supply();

        return [
            'supply' => $supply,
        ];
    }

    /**
     * Название экрана, отображаемое в заголовке.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->query()['supply']->exists ? 'Редактирование товара' : 'Создание товара';
    }

    /**
     * Кнопки действий экрана.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make($this->query()['supply']->exists ? 'Сохранить изменения' : 'Создать товар')
                ->icon('bs.save')
                ->method('saveSupply'),
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

    /**
     * Сохранение товара.
     *
     * @param Supply $supply
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSupply(Supply $supply)
    {
        $data = request()->input('supply');
        $supply->fill($data);
        $supply->save();

        Toast::success($supply->exists ? 'Товар обновлен' : 'Товар создан');

        return redirect()->route('platform.supplies');
    }
}
