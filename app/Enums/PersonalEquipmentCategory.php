<?php

namespace App\Enums;

enum PersonalEquipmentCategory: string
{
    case BACKPACK = '大背包';
    case BACKPACK_COVER = '背包套';
    case SLEEPING_BAG = '睡袋';
    case SLEEPING_PAD = '睡墊';
    case HEADLAMP = '頭燈';
    case TREKKING_POLE = '登山杖 (支)';
    case CARABINER = '大D';
    case FIGURE_EIGHT = '八字';
    case SLING = 'sling';
    case HELMET = '頭盔';
    case CANYONING_HARNESS = '吊帶';
    case LIFE_JACKET = '救生衣';
    case WATER_SHOES = '溯溪鞋';
}
