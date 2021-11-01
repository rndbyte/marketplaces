<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Results\V2;

use stdClass;
use Marketplaces\Components\Abstracts\AbstractMarketplaceResponse;

/**
 * Class ProductInfoResponseResultDTO
 * @package Marketplaces\Modules\Ozon\Results\V2
 * @property int id Идентификатор характеристики товара.
 * @property string name Название товара. До 500 символов.
 * @property string offer_id Идентификатор товара в системе продавца.
 * @property string barcode Штрихкод товара.
 * @property string buybox_price Цена главного предложения на Ozon. Устаревший параметр, больше не используется.
 * @property int category_id Идентификатор категории товара.
 * @property string created_at Дата и время создания товара.
 * @property array images Массив url для изображений товара.
 * @property string marketing_price Цена на товар с учетом всех акций. Это значение будет указано на витрине Ozon.
 * @property string min_ozon_price Минимальная цена на аналогичный товара на Ozon.
 * @property string old_price Цена до учета скидок, на карточке товара отображается зачеркнутой.
 * @property string premium_price Цена для клиентов с подпиской Ozon Premium.
 * @property string price Информация о цене товара.
 * @property string recommended_price Цена на товар, рекомендованная системой на основании схожих предложений.
 * @property array sources Информация о SKU Ozon.
 * @property string state Статус добваления товара с систему.
 * @property object stocks Информация о количестве товара.
 * @property array errors Информация об ошибках валидации товара.
 * @property string vat Ставка НДС для товара.
 * @property bool visible Товар доступен на Ozon для покупки.
 * @property object visibility_details Параметры видимости товара.
 * @property string price_index Ценовой индекс.
 * @property array commissions Информация о комиссиях.
 * @property int volume_weight Объемный вес товара.
 * @property bool is_prepayment Флаг обязательной предоплаты для товара.
 * @property bool is_prepayment_allowed Undefined?
 */
final class ProductInfoResult extends AbstractMarketplaceResponse
{
    public static function fromObject(stdClass $result): self
    {
        $data = $result;
        if (property_exists($data, 'result')) {
            $data = $data->result;
        }
        return new self($data);
    }
}
