<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class Currencyseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currency = [
            0 => [
                'currency' => 'AED',
                'unit_text' => 'UAE Dirham',
                'symbol' => '',
            ],
            1 => [
                'currency' => 'AFN',
                'unit_text' => 'Afghani',
                'symbol' => '؋',
            ],
            2 => [
                'currency' => 'ALL',
                'unit_text' => 'Lek',
                'symbol' => 'Lek',
            ],
            3 => [
                'currency' => 'AMD',
                'unit_text' => 'Armenian Dram',
                'symbol' => '',
            ],
            4 => [
                'currency' => 'ANG',
                'unit_text' => 'Netherlands Antillian Guilder',
                'symbol' => 'ƒ',
            ],
            5 => [
                'currency' => 'AOA',
                'unit_text' => 'Kwanza',
                'symbol' => '',
            ],
            6 => [
                'currency' => 'ARS',
                'unit_text' => 'Argentine Peso',
                'symbol' => '$',
            ],
            7 => [
                'currency' => 'AUD',
                'unit_text' => 'Australian Dollar',
                'symbol' => '$',
            ],
            8 => [
                'currency' => 'AWG',
                'unit_text' => 'Aruban Guilder',
                'symbol' => 'ƒ',
            ],
            9 => [
                'currency' => 'AZN',
                'unit_text' => 'Azerbaijanian Manat',
                'symbol' => 'ман',
            ],
            10 => [
                'currency' => 'BAM',
                'unit_text' => 'Convertible Marks',
                'symbol' => 'KM',
            ],
            11 => [
                'currency' => 'BBD',
                'unit_text' => 'Barbados Dollar',
                'symbol' => '$',
            ],
            12 => [
                'currency' => 'BDT',
                'unit_text' => 'Taka',
                'symbol' => '',
            ],
            13 => [
                'currency' => 'BGN',
                'unit_text' => 'Bulgarian Lev',
                'symbol' => 'лв',
            ],
            14 => [
                'currency' => 'BHD',
                'unit_text' => 'Bahraini Dinar',
                'symbol' => '',
            ],
            15 => [
                'currency' => 'BIF',
                'unit_text' => 'Burundi Franc',
                'symbol' => '',
            ],
            16 => [
                'currency' => 'BMD',
                'unit_text' => 'Bermudian Dollar (customarily known as Bermuda Dollar)',
                'symbol' => '$',
            ],
            17 => [
                'currency' => 'BND',
                'unit_text' => 'Brunei Dollar',
                'symbol' => '$',
            ],
            18 => [
                'currency' => 'BOB BOV',
                'unit_text' => 'Boliviano Mvdol',
                'symbol' => '$b',
            ],
            19 => [
                'currency' => 'BRL',
                'unit_text' => 'Brazilian Real',
                'symbol' => 'R$',
            ],
            20 => [
                'currency' => 'BSD',
                'unit_text' => 'Bahamian Dollar',
                'symbol' => '$',
            ],
            21 => [
                'currency' => 'BWP',
                'unit_text' => 'Pula',
                'symbol' => 'P',
            ],
            22 => [
                'currency' => 'BYR',
                'unit_text' => 'Belarussian Ruble',
                'symbol' => 'p.',
            ],
            23 => [
                'currency' => 'BZD',
                'unit_text' => 'Belize Dollar',
                'symbol' => 'BZ$',
            ],
            24 => [
                'currency' => 'CAD',
                'unit_text' => 'Canadian Dollar',
                'symbol' => '$',
            ],
            25 => [
                'currency' => 'CDF',
                'unit_text' => 'Congolese Franc',
                'symbol' => '',
            ],
            26 => [
                'currency' => 'CHF',
                'unit_text' => 'Swiss Franc',
                'symbol' => 'CHF',
            ],
            27 => [
                'currency' => 'CLP CLF',
                'unit_text' => 'Chilean Peso Unidades de fomento',
                'symbol' => '$',
            ],
            28 => [
                'currency' => 'CNY',
                'unit_text' => 'Yuan Renminbi',
                'symbol' => '¥',
            ],
            29 => [
                'currency' => 'COP COU',
                'unit_text' => 'Colombian Peso Unidad de Valor Real',
                'symbol' => '$',
            ],
            30 => [
                'currency' => 'CRC',
                'unit_text' => 'Costa Rican Colon',
                'symbol' => '₡',
            ],
            31 => [
                'currency' => 'CUP CUC',
                'unit_text' => 'Cuban Peso Peso Convertible',
                'symbol' => '₱',
            ],
            32 => [
                'currency' => 'CVE',
                'unit_text' => 'Cape Verde Escudo',
                'symbol' => '',
            ],
            33 => [
                'currency' => 'CZK',
                'unit_text' => 'Czech Koruna',
                'symbol' => 'Kč',
            ],
            34 => [
                'currency' => 'DJF',
                'unit_text' => 'Djibouti Franc',
                'symbol' => '',
            ],
            35 => [
                'currency' => 'DKK',
                'unit_text' => 'Danish Krone',
                'symbol' => 'kr',
            ],
            36 => [
                'currency' => 'DOP',
                'unit_text' => 'Dominican Peso',
                'symbol' => 'RD$',
            ],
            37 => [
                'currency' => 'DZD',
                'unit_text' => 'Algerian Dinar',
                'symbol' => '',
            ],
            38 => [
                'currency' => 'EEK',
                'unit_text' => 'Kroon',
                'symbol' => '',
            ],
            39 => [
                'currency' => 'EGP',
                'unit_text' => 'Egyptian Pound',
                'symbol' => '£',
            ],
            40 => [
                'currency' => 'ERN',
                'unit_text' => 'Nakfa',
                'symbol' => '',
            ],
            41 => [
                'currency' => 'ETB',
                'unit_text' => 'Ethiopian Birr',
                'symbol' => '',
            ],
            42 => [
                'currency' => 'EUR',
                'unit_text' => 'Euro',
                'symbol' => '€',
            ],
            43 => [
                'currency' => 'FJD',
                'unit_text' => 'Fiji Dollar',
                'symbol' => '$',
            ],
            44 => [
                'currency' => 'FKP',
                'unit_text' => 'Falkland Islands Pound',
                'symbol' => '£',
            ],
            45 => [
                'currency' => 'GBP',
                'unit_text' => 'Pound Sterling',
                'symbol' => '£',
            ],
            46 => [
                'currency' => 'GEL',
                'unit_text' => 'Lari',
                'symbol' => '',
            ],
            47 => [
                'currency' => 'GHS',
                'unit_text' => 'Cedi',
                'symbol' => '',
            ],
            48 => [
                'currency' => 'GIP',
                'unit_text' => 'Gibraltar Pound',
                'symbol' => '£',
            ],
            49 => [
                'currency' => 'GMD',
                'unit_text' => 'Dalasi',
                'symbol' => '',
            ],
            50 => [
                'currency' => 'GNF',
                'unit_text' => 'Guinea Franc',
                'symbol' => '',
            ],
            51 => [
                'currency' => 'GTQ',
                'unit_text' => 'Quetzal',
                'symbol' => 'Q',
            ],
            52 => [
                'currency' => 'GYD',
                'unit_text' => 'Guyana Dollar',
                'symbol' => '$',
            ],
            53 => [
                'currency' => 'HKD',
                'unit_text' => 'Hong Kong Dollar',
                'symbol' => '$',
            ],
            54 => [
                'currency' => 'HNL',
                'unit_text' => 'Lempira',
                'symbol' => 'L',
            ],
            55 => [
                'currency' => 'HRK',
                'unit_text' => 'Croatian Kuna',
                'symbol' => 'kn',
            ],
            56 => [
                'currency' => 'HTG USD',
                'unit_text' => 'Gourde US Dollar',
                'symbol' => '',
            ],
            57 => [
                'currency' => 'HUF',
                'unit_text' => 'Forint',
                'symbol' => 'Ft',
            ],
            58 => [
                'currency' => 'IDR',
                'unit_text' => 'Rupiah',
                'symbol' => 'Rp',
            ],
            59 => [
                'currency' => 'ILS',
                'unit_text' => 'New Israeli Sheqel',
                'symbol' => '₪',
            ],
            60 => [
                'currency' => 'INR',
                'unit_text' => 'Indian Rupee',
                'symbol' => '',
            ],
            61 => [
                'currency' => 'INR BTN',
                'unit_text' => 'Indian Rupee Ngultrum',
                'symbol' => '',
            ],
            62 => [
                'currency' => 'IQD',
                'unit_text' => 'Iraqi Dinar',
                'symbol' => '',
            ],
            63 => [
                'currency' => 'IRR',
                'unit_text' => 'Iranian Rial',
                'symbol' => '﷼',
            ],
            64 => [
                'currency' => 'ISK',
                'unit_text' => 'Iceland Krona',
                'symbol' => 'kr',
            ],
            65 => [
                'currency' => 'JMD',
                'unit_text' => 'Jamaican Dollar',
                'symbol' => 'J$',
            ],
            66 => [
                'currency' => 'JOD',
                'unit_text' => 'Jordanian Dinar',
                'symbol' => '',
            ],
            67 => [
                'currency' => 'JPY',
                'unit_text' => 'Yen',
                'symbol' => '¥',
            ],
            68 => [
                'currency' => 'KES',
                'unit_text' => 'Kenyan Shilling',
                'symbol' => '',
            ],
            69 => [
                'currency' => 'KGS',
                'unit_text' => 'Som',
                'symbol' => 'лв',
            ],
            70 => [
                'currency' => 'KHR',
                'unit_text' => 'Riel',
                'symbol' => '៛',
            ],
            71 => [
                'currency' => 'KMF',
                'unit_text' => 'Comoro Franc',
                'symbol' => '',
            ],
            72 => [
                'currency' => 'KPW',
                'unit_text' => 'North Korean Won',
                'symbol' => '₩',
            ],
            73 => [
                'currency' => 'KRW',
                'unit_text' => 'Won',
                'symbol' => '₩',
            ],
            74 => [
                'currency' => 'KWD',
                'unit_text' => 'Kuwaiti Dinar',
                'symbol' => '',
            ],
            75 => [
                'currency' => 'KYD',
                'unit_text' => 'Cayman Islands Dollar',
                'symbol' => '$',
            ],
            76 => [
                'currency' => 'KZT',
                'unit_text' => 'Tenge',
                'symbol' => 'лв',
            ],
            77 => [
                'currency' => 'LAK',
                'unit_text' => 'Kip',
                'symbol' => '₭',
            ],
            78 => [
                'currency' => 'LBP',
                'unit_text' => 'Lebanese Pound',
                'symbol' => '£',
            ],
            79 => [
                'currency' => 'LKR',
                'unit_text' => 'Sri Lanka Rupee',
                'symbol' => '₨',
            ],
            80 => [
                'currency' => 'LRD',
                'unit_text' => 'Liberian Dollar',
                'symbol' => '$',
            ],
            81 => [
                'currency' => 'LTL',
                'unit_text' => 'Lithuanian Litas',
                'symbol' => 'Lt',
            ],
            82 => [
                'currency' => 'LVL',
                'unit_text' => 'Latvian Lats',
                'symbol' => 'Ls',
            ],
            83 => [
                'currency' => 'LYD',
                'unit_text' => 'Libyan Dinar',
                'symbol' => '',
            ],
            84 => [
                'currency' => 'MAD',
                'unit_text' => 'Moroccan Dirham',
                'symbol' => '',
            ],
            85 => [
                'currency' => 'MDL',
                'unit_text' => 'Moldovan Leu',
                'symbol' => '',
            ],
            86 => [
                'currency' => 'MGA',
                'unit_text' => 'Malagasy Ariary',
                'symbol' => '',
            ],
            87 => [
                'currency' => 'MKD',
                'unit_text' => 'Denar',
                'symbol' => 'ден',
            ],
            88 => [
                'currency' => 'MMK',
                'unit_text' => 'Kyat',
                'symbol' => '',
            ],
            89 => [
                'currency' => 'MNT',
                'unit_text' => 'Tugrik',
                'symbol' => '₮',
            ],
            90 => [
                'currency' => 'MOP',
                'unit_text' => 'Pataca',
                'symbol' => '',
            ],
            91 => [
                'currency' => 'MRO',
                'unit_text' => 'Ouguiya',
                'symbol' => '',
            ],
            92 => [
                'currency' => 'MUR',
                'unit_text' => 'Mauritius Rupee',
                'symbol' => '₨',
            ],
            93 => [
                'currency' => 'MVR',
                'unit_text' => 'Rufiyaa',
                'symbol' => '',
            ],
            94 => [
                'currency' => 'MWK',
                'unit_text' => 'Kwacha',
                'symbol' => '',
            ],
            95 => [
                'currency' => 'MXN MXV',
                'unit_text' => 'Mexican Peso Mexican Unidad de Inversion (UDI)',
                'symbol' => '$',
            ],
            96 => [
                'currency' => 'MYR',
                'unit_text' => 'Malaysian Ringgit',
                'symbol' => 'RM',
            ],
            97 => [
                'currency' => 'MZN',
                'unit_text' => 'Metical',
                'symbol' => 'MT',
            ],
            98 => [
                'currency' => 'NGN',
                'unit_text' => 'Naira',
                'symbol' => '₦',
            ],
            99 => [
                'currency' => 'NIO',
                'unit_text' => 'Cordoba Oro',
                'symbol' => 'C$',
            ],
            100 => [
                'currency' => 'NOK',
                'unit_text' => 'Norwegian Krone',
                'symbol' => 'kr',
            ],
            101 => [
                'currency' => 'NPR',
                'unit_text' => 'Nepalese Rupee',
                'symbol' => '₨',
            ],
            102 => [
                'currency' => 'NZD',
                'unit_text' => 'New Zealand Dollar',
                'symbol' => '$',
            ],
            103 => [
                'currency' => 'OMR',
                'unit_text' => 'Rial Omani',
                'symbol' => '﷼',
            ],
            104 => [
                'currency' => 'PAB USD',
                'unit_text' => 'Balboa US Dollar',
                'symbol' => 'B/.',
            ],
            105 => [
                'currency' => 'PEN',
                'unit_text' => 'Nuevo Sol',
                'symbol' => 'S/.',
            ],
            106 => [
                'currency' => 'PGK',
                'unit_text' => 'Kina',
                'symbol' => '',
            ],
            107 => [
                'currency' => 'PHP',
                'unit_text' => 'Philippine Peso',
                'symbol' => 'Php',
            ],
            108 => [
                'currency' => 'PKR',
                'unit_text' => 'Pakistan Rupee',
                'symbol' => '₨',
            ],
            109 => [
                'currency' => 'PLN',
                'unit_text' => 'Zloty',
                'symbol' => 'zł',
            ],
            110 => [
                'currency' => 'PYG',
                'unit_text' => 'Guarani',
                'symbol' => 'Gs',
            ],
            111 => [
                'currency' => 'QAR',
                'unit_text' => 'Qatari Rial',
                'symbol' => '﷼',
            ],
            112 => [
                'currency' => 'RON',
                'unit_text' => 'New Leu',
                'symbol' => 'lei',
            ],
            113 => [
                'currency' => 'RSD',
                'unit_text' => 'Serbian Dinar',
                'symbol' => 'Дин.',
            ],
            114 => [
                'currency' => 'RUB',
                'unit_text' => 'Russian Ruble',
                'symbol' => 'руб',
            ],
            115 => [
                'currency' => 'RWF',
                'unit_text' => 'Rwanda Franc',
                'symbol' => '',
            ],
            116 => [
                'currency' => 'SAR',
                'unit_text' => 'Saudi Riyal',
                'symbol' => '﷼',
            ],
            117 => [
                'currency' => 'SBD',
                'unit_text' => 'Solomon Islands Dollar',
                'symbol' => '$',
            ],
            118 => [
                'currency' => 'SCR',
                'unit_text' => 'Seychelles Rupee',
                'symbol' => '₨',
            ],
            119 => [
                'currency' => 'SDG',
                'unit_text' => 'Sudanese Pound',
                'symbol' => '',
            ],
            120 => [
                'currency' => 'SEK',
                'unit_text' => 'Swedish Krona',
                'symbol' => 'kr',
            ],
            121 => [
                'currency' => 'SGD',
                'unit_text' => 'Singapore Dollar',
                'symbol' => '$',
            ],
            122 => [
                'currency' => 'SHP',
                'unit_text' => 'Saint Helena Pound',
                'symbol' => '£',
            ],
            123 => [
                'currency' => 'SLL',
                'unit_text' => 'Leone',
                'symbol' => '',
            ],
            124 => [
                'currency' => 'SOS',
                'unit_text' => 'Somali Shilling',
                'symbol' => 'S',
            ],
            125 => [
                'currency' => 'SRD',
                'unit_text' => 'Surinam Dollar',
                'symbol' => '$',
            ],
            126 => [
                'currency' => 'STD',
                'unit_text' => 'Dobra',
                'symbol' => '',
            ],
            127 => [
                'currency' => 'SVC USD',
                'unit_text' => 'El Salvador Colon US Dollar',
                'symbol' => '$',
            ],
            128 => [
                'currency' => 'SYP',
                'unit_text' => 'Syrian Pound',
                'symbol' => '£',
            ],
            129 => [
                'currency' => 'SZL',
                'unit_text' => 'Lilangeni',
                'symbol' => '',
            ],
            130 => [
                'currency' => 'THB',
                'unit_text' => 'Baht',
                'symbol' => '฿',
            ],
            131 => [
                'currency' => 'TJS',
                'unit_text' => 'Somoni',
                'symbol' => '',
            ],
            132 => [
                'currency' => 'TMT',
                'unit_text' => 'Manat',
                'symbol' => '',
            ],
            133 => [
                'currency' => 'TND',
                'unit_text' => 'Tunisian Dinar',
                'symbol' => '',
            ],
            134 => [
                'currency' => 'TOP',
                'unit_text' => 'Pa\'anga',
                'symbol' => '',
            ],
            135 => [
                'currency' => 'TRY',
                'unit_text' => 'Turkish Lira',
                'symbol' => 'TL',
            ],
            136 => [
                'currency' => 'TTD',
                'unit_text' => 'Trinidad and Tobago Dollar',
                'symbol' => 'TT$',
            ],
            137 => [
                'currency' => 'TWD',
                'unit_text' => 'New Taiwan Dollar',
                'symbol' => 'NT$',
            ],
            138 => [
                'currency' => 'TZS',
                'unit_text' => 'Tanzanian Shilling',
                'symbol' => '',
            ],
            139 => [
                'currency' => 'UAH',
                'unit_text' => 'Hryvnia',
                'symbol' => '₴',
            ],
            140 => [
                'currency' => 'UGX',
                'unit_text' => 'Uganda Shilling',
                'symbol' => '',
            ],
            141 => [
                'currency' => 'USD',
                'unit_text' => 'US Dollar',
                'symbol' => '$',
            ],
            142 => [
                'currency' => 'UYU UYI',
                'unit_text' => 'Peso Uruguayo Uruguay Peso en Unidades Indexadas',
                'symbol' => '$U',
            ],
            143 => [
                'currency' => 'UZS',
                'unit_text' => 'Uzbekistan Sum',
                'symbol' => 'лв',
            ],
            144 => [
                'currency' => 'VEF',
                'unit_text' => 'Bolivar Fuerte',
                'symbol' => 'Bs',
            ],
            145 => [
                'currency' => 'VND',
                'unit_text' => 'Dong',
                'symbol' => '₫',
            ],
            146 => [
                'currency' => 'VUV',
                'unit_text' => 'Vatu',
                'symbol' => '',
            ],
            147 => [
                'currency' => 'WST',
                'unit_text' => 'Tala',
                'symbol' => '',
            ],
            148 => [
                'currency' => 'XAF',
                'unit_text' => 'CFA Franc BEAC',
                'symbol' => '',
            ],
            149 => [
                'currency' => 'XAG',
                'unit_text' => 'Silver',
                'symbol' => '',
            ],
            150 => [
                'currency' => 'XAU',
                'unit_text' => 'Gold',
                'symbol' => '',
            ],
            151 => [
                'currency' => 'XBA',
                'unit_text' => 'Bond Markets Units European Composite Unit (EURCO)',
                'symbol' => '',
            ],
            152 => [
                'currency' => 'XBB',
                'unit_text' => 'European Monetary Unit (E.M.U.-6)',
                'symbol' => '',
            ],
            153 => [
                'currency' => 'XBC',
                'unit_text' => 'European Unit of Account 9(E.U.A.-9)',
                'symbol' => '',
            ],
            154 => [
                'currency' => 'XBD',
                'unit_text' => 'European Unit of Account 17(E.U.A.-17)',
                'symbol' => '',
            ],
            155 => [
                'currency' => 'XCD',
                'unit_text' => 'East Caribbean Dollar',
                'symbol' => '$',
            ],
            156 => [
                'currency' => 'XDR',
                'unit_text' => 'SDR',
                'symbol' => '',
            ],
            157 => [
                'currency' => 'XFU',
                'unit_text' => 'UIC-Franc',
                'symbol' => '',
            ],
            158 => [
                'currency' => 'XOF',
                'unit_text' => 'CFA Franc BCEAO',
                'symbol' => '',
            ],
            159 => [
                'currency' => 'XPD',
                'unit_text' => 'Palladium',
                'symbol' => '',
            ],
            160 => [
                'currency' => 'XPF',
                'unit_text' => 'CFP Franc',
                'symbol' => '',
            ],
            161 => [
                'currency' => 'XPT',
                'unit_text' => 'Platinum',
                'symbol' => '',
            ],
            162 => [
                'currency' => 'XTS',
                'unit_text' => 'Codes specifically reserved for testing purposes',
                'symbol' => '',
            ],
            163 => [
                'currency' => 'YER',
                'unit_text' => 'Yemeni Rial',
                'symbol' => '﷼',
            ],
            164 => [
                'currency' => 'ZAR',
                'unit_text' => 'Rand',
                'symbol' => 'R',
            ],
            165 => [
                'currency' => 'ZAR LSL',
                'unit_text' => 'Rand Loti',
                'symbol' => '',
            ],
            166 => [
                'currency' => 'ZAR NAD',
                'unit_text' => 'Rand Namibia Dollar',
                'symbol' => '',
            ],
            167 => [
                'currency' => 'ZMK',
                'unit_text' => 'Zambian Kwacha',
                'symbol' => '',
            ],
            168 => [
                'currency' => 'ZWL',
                'unit_text' => 'Zimbabwe Dollar',
                'symbol' => '',
            ],
        ];

        foreach($currency as $key => $currency){
            Currency::updateOrCreate([
                'name' => $currency['unit_text']
            ],[
                'code' => $currency['currency'],
                'symbol' => $currency['symbol']
            ]);
        }
    }
}
