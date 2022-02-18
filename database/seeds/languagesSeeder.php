<?php

use App\Models\Languages;
use Illuminate\Database\Seeder;

class languagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages =  array (
            'aa' =>
            array (
            'iso_639_no' => 'aa',
            'Language name' => 'Afar',
            ),
            'ab' =>
            array (
            'iso_639_no' => 'ab',
            'Language name' => 'Abkhaz',
            ),
            'ae' =>
            array (
            'iso_639_no' => 'ae',
            'Language name' => 'Avestan',
            ),
            'af' =>
            array (
            'iso_639_no' => 'af',
            'Language name' => 'Afrikaans',
            ),
            'ak' =>
            array (
            'iso_639_no' => 'ak',
            'Language name' => 'Akan',
            ),
            'am' =>
            array (
            'iso_639_no' => 'am',
            'Language name' => 'Amharic',
            ),
            'an' =>
            array (
            'iso_639_no' => 'an',
            'Language name' => 'Aragonese',
            ),
            'ar' =>
            array (
            'iso_639_no' => 'ar',
            'Language name' => 'Arabic',
            ),
            'as' =>
            array (
            'iso_639_no' => 'as',
            'Language name' => 'Assamese',
            ),
            'av' =>
            array (
            'iso_639_no' => 'av',
            'Language name' => 'Avaric',
            ),
            'ay' =>
            array (
            'iso_639_no' => 'ay',
            'Language name' => 'Aymara',
            ),
            'az' =>
            array (
            'iso_639_no' => 'az',
            'Language name' => 'South Azerbaijani',
            ),
            'ba' =>
            array (
            'iso_639_no' => 'ba',
            'Language name' => 'Bashkir',
            ),
            'be' =>
            array (
            'iso_639_no' => 'be',
            'Language name' => 'Belarusian',
            ),
            'bg' =>
            array (
            'iso_639_no' => 'bg',
            'Language name' => 'Bulgarian',
            ),
            'bh' =>
            array (
            'iso_639_no' => 'bh',
            'Language name' => 'Bihari',
            ),
            'bi' =>
            array (
            'iso_639_no' => 'bi',
            'Language name' => 'Bislama',
            ),
            'bm' =>
            array (
            'iso_639_no' => 'bm',
            'Language name' => 'Bambara',
            ),
            'bn' =>
            array (
            'iso_639_no' => 'bn',
            'Language name' => 'Bengali; Bangla',
            ),
            'bo' =>
            array (
            'iso_639_no' => 'bo',
            'Language name' => 'Tibetan Standard, Tibetan, Central',
            ),
            'br' =>
            array (
            'iso_639_no' => 'br',
            'Language name' => 'Breton',
            ),
            'bs' =>
            array (
            'iso_639_no' => 'bs',
            'Language name' => 'Bosnian',
            ),
            'ca' =>
            array (
            'iso_639_no' => 'ca',
            'Language name' => 'Catalan; Valencian',
            ),
            'ce' =>
            array (
            'iso_639_no' => 'ce',
            'Language name' => 'Chechen',
            ),
            'ch' =>
            array (
            'iso_639_no' => 'ch',
            'Language name' => 'Chamorro',
            ),
            'co' =>
            array (
            'iso_639_no' => 'co',
            'Language name' => 'Corsican',
            ),
            'cr' =>
            array (
            'iso_639_no' => 'cr',
            'Language name' => 'Cree',
            ),
            'cs' =>
            array (
            'iso_639_no' => 'cs',
            'Language name' => 'Czech',
            ),
            'cu' =>
            array (
            'iso_639_no' => 'cu',
            'Language name' => 'Old Church Slavonic, Church Slavonic, Old Bulgarian',
            ),
            'cv' =>
            array (
            'iso_639_no' => 'cv',
            'Language name' => 'Chuvash',
            ),
            'cy' =>
            array (
            'iso_639_no' => 'cy',
            'Language name' => 'Welsh',
            ),
            'da' =>
            array (
            'iso_639_no' => 'da',
            'Language name' => 'Danish',
            ),
            'de' =>
            array (
            'iso_639_no' => 'de',
            'Language name' => 'German',
            ),
            'dv' =>
            array (
            'iso_639_no' => 'dv',
            'Language name' => 'Divehi; Dhivehi; Maldivian;',
            ),
            'dz' =>
            array (
            'iso_639_no' => 'dz',
            'Language name' => 'Dzongkha',
            ),
            'ee' =>
            array (
            'iso_639_no' => 'ee',
            'Language name' => 'Ewe',
            ),
            'el' =>
            array (
            'iso_639_no' => 'el',
            'Language name' => 'Greek, Modern',
            ),
            'en' =>
            array (
            'iso_639_no' => 'en',
            'Language name' => 'English',
            ),
            'eo' =>
            array (
            'iso_639_no' => 'eo',
            'Language name' => 'Esperanto',
            ),
            'es' =>
            array (
            'iso_639_no' => 'es',
            'Language name' => 'Spanish; Castilian',
            ),
            'et' =>
            array (
            'iso_639_no' => 'et',
            'Language name' => 'Estonian',
            ),
            'eu' =>
            array (
            'iso_639_no' => 'eu',
            'Language name' => 'Basque',
            ),
            'fa' =>
            array (
            'iso_639_no' => 'fa',
            'Language name' => 'Persian (Farsi)',
            ),
            'ff' =>
            array (
            'iso_639_no' => 'ff',
            'Language name' => 'Fula; Fulah; Pulaar; Pular',
            ),
            'fi' =>
            array (
            'iso_639_no' => 'fi',
            'Language name' => 'Finnish',
            ),
            'fj' =>
            array (
            'iso_639_no' => 'fj',
            'Language name' => 'Fijian',
            ),
            'fo' =>
            array (
            'iso_639_no' => 'fo',
            'Language name' => 'Faroese',
            ),
            'fr' =>
            array (
            'iso_639_no' => 'fr',
            'Language name' => 'French',
            ),
            'fy' =>
            array (
            'iso_639_no' => 'fy',
            'Language name' => 'Western Frisian',
            ),
            'ga' =>
            array (
            'iso_639_no' => 'ga',
            'Language name' => 'Irish',
            ),
            'gd' =>
            array (
            'iso_639_no' => 'gd',
            'Language name' => 'Scottish Gaelic; Gaelic',
            ),
            'gl' =>
            array (
            'iso_639_no' => 'gl',
            'Language name' => 'Galician',
            ),
            'gn' =>
            array (
            'iso_639_no' => 'gn',
            'Language name' => 'Guaraní',
            ),
            'gu' =>
            array (
            'iso_639_no' => 'gu',
            'Language name' => 'Gujarati',
            ),
            'gv' =>
            array (
            'iso_639_no' => 'gv',
            'Language name' => 'Manx',
            ),
            'ha' =>
            array (
            'iso_639_no' => 'ha',
            'Language name' => 'Hausa',
            ),
            'he' =>
            array (
            'iso_639_no' => 'he',
            'Language name' => 'Hebrew (modern)',
            ),
            'hi' =>
            array (
            'iso_639_no' => 'hi',
            'Language name' => 'Hindi',
            ),
            'ho' =>
            array (
            'iso_639_no' => 'ho',
            'Language name' => 'Hiri Motu',
            ),
            'hr' =>
            array (
            'iso_639_no' => 'hr',
            'Language name' => 'Croatian',
            ),
            'ht' =>
            array (
            'iso_639_no' => 'ht',
            'Language name' => 'Haitian; Haitian Creole',
            ),
            'hu' =>
            array (
            'iso_639_no' => 'hu',
            'Language name' => 'Hungarian',
            ),
            'hy' =>
            array (
            'iso_639_no' => 'hy',
            'Language name' => 'Armenian',
            ),
            'hz' =>
            array (
            'iso_639_no' => 'hz',
            'Language name' => 'Herero',
            ),
            'ia' =>
            array (
            'iso_639_no' => 'ia',
            'Language name' => 'Interlingua',
            ),
            'id' =>
            array (
            'iso_639_no' => 'id',
            'Language name' => 'Indonesian',
            ),
            'ie' =>
            array (
            'iso_639_no' => 'ie',
            'Language name' => 'Interlingue',
            ),
            'ig' =>
            array (
            'iso_639_no' => 'ig',
            'Language name' => 'Igbo',
            ),
            'ii' =>
            array (
            'iso_639_no' => 'ii',
            'Language name' => 'Nuosu',
            ),
            'ik' =>
            array (
            'iso_639_no' => 'ik',
            'Language name' => 'Inupiaq',
            ),
            'io' =>
            array (
            'iso_639_no' => 'io',
            'Language name' => 'Ido',
            ),
            'is' =>
            array (
            'iso_639_no' => 'is',
            'Language name' => 'Icelandic',
            ),
            'it' =>
            array (
            'iso_639_no' => 'it',
            'Language name' => 'Italian',
            ),
            'iu' =>
            array (
            'iso_639_no' => 'iu',
            'Language name' => 'Inuktitut',
            ),
            'ja' =>
            array (
            'iso_639_no' => 'ja',
            'Language name' => 'Japanese',
            ),
            'jv' =>
            array (
            'iso_639_no' => 'jv',
            'Language name' => 'Javanese',
            ),
            'ka' =>
            array (
            'iso_639_no' => 'ka',
            'Language name' => 'Georgian',
            ),
            'kg' =>
            array (
            'iso_639_no' => 'kg',
            'Language name' => 'Kongo',
            ),
            'ki' =>
            array (
            'iso_639_no' => 'ki',
            'Language name' => 'Kikuyu, Gikuyu',
            ),
            'kj' =>
            array (
            'iso_639_no' => 'kj',
            'Language name' => 'Kwanyama, Kuanyama',
            ),
            'kk' =>
            array (
            'iso_639_no' => 'kk',
            'Language name' => 'Kazakh',
            ),
            'kl' =>
            array (
            'iso_639_no' => 'kl',
            'Language name' => 'Kalaallisut, Greenlandic',
            ),
            'km' =>
            array (
            'iso_639_no' => 'km',
            'Language name' => 'Khmer',
            ),
            'kn' =>
            array (
            'iso_639_no' => 'kn',
            'Language name' => 'Kannada',
            ),
            'ko' =>
            array (
            'iso_639_no' => 'ko',
            'Language name' => 'Korean',
            ),
            'kr' =>
            array (
            'iso_639_no' => 'kr',
            'Language name' => 'Kanuri',
            ),
            'ks' =>
            array (
            'iso_639_no' => 'ks',
            'Language name' => 'Kashmiri',
            ),
            'ku' =>
            array (
            'iso_639_no' => 'ku',
            'Language name' => 'Kurdish',
            ),
            'kv' =>
            array (
            'iso_639_no' => 'kv',
            'Language name' => 'Komi',
            ),
            'kw' =>
            array (
            'iso_639_no' => 'kw',
            'Language name' => 'Cornish',
            ),
            'ky' =>
            array (
            'iso_639_no' => 'ky',
            'Language name' => 'Kyrgyz',
            ),
            'la' =>
            array (
            'iso_639_no' => 'la',
            'Language name' => 'Latin',
            ),
            'lb' =>
            array (
            'iso_639_no' => 'lb',
            'Language name' => 'Luxembourgish, Letzeburgesch',
            ),
            'lg' =>
            array (
            'iso_639_no' => 'lg',
            'Language name' => 'Ganda',
            ),
            'li' =>
            array (
            'iso_639_no' => 'li',
            'Language name' => 'Limburgish, Limburgan, Limburger',
            ),
            'ln' =>
            array (
            'iso_639_no' => 'ln',
            'Language name' => 'Lingala',
            ),
            'lo' =>
            array (
            'iso_639_no' => 'lo',
            'Language name' => 'Lao',
            ),
            'lt' =>
            array (
            'iso_639_no' => 'lt',
            'Language name' => 'Lithuanian',
            ),
            'lu' =>
            array (
            'iso_639_no' => 'lu',
            'Language name' => 'Luba-Katanga',
            ),
            'lv' =>
            array (
            'iso_639_no' => 'lv',
            'Language name' => 'Latvian',
            ),
            'mg' =>
            array (
            'iso_639_no' => 'mg',
            'Language name' => 'Malagasy',
            ),
            'mh' =>
            array (
            'iso_639_no' => 'mh',
            'Language name' => 'Marshallese',
            ),
            'mi' =>
            array (
            'iso_639_no' => 'mi',
            'Language name' => 'Māori',
            ),
            'mk' =>
            array (
            'iso_639_no' => 'mk',
            'Language name' => 'Macedonian',
            ),
            'ml' =>
            array (
            'iso_639_no' => 'ml',
            'Language name' => 'Malayalam',
            ),
            'mn' =>
            array (
            'iso_639_no' => 'mn',
            'Language name' => 'Mongolian',
            ),
            'mr' =>
            array (
            'iso_639_no' => 'mr',
            'Language name' => 'Marathi (Marāṭhī)',
            ),
            'ms' =>
            array (
            'iso_639_no' => 'ms',
            'Language name' => 'Malay',
            ),
            'mt' =>
            array (
            'iso_639_no' => 'mt',
            'Language name' => 'Maltese',
            ),
            'my' =>
            array (
            'iso_639_no' => 'my',
            'Language name' => 'Burmese',
            ),
            'na' =>
            array (
            'iso_639_no' => 'na',
            'Language name' => 'Nauru',
            ),
            'nb' =>
            array (
            'iso_639_no' => 'nb',
            'Language name' => 'Norwegian Bokmål',
            ),
            'nd' =>
            array (
            'iso_639_no' => 'nd',
            'Language name' => 'North Ndebele',
            ),
            'ne' =>
            array (
            'iso_639_no' => 'ne',
            'Language name' => 'Nepali',
            ),
            'ng' =>
            array (
            'iso_639_no' => 'ng',
            'Language name' => 'Ndonga',
            ),
            'nl' =>
            array (
            'iso_639_no' => 'nl',
            'Language name' => 'Dutch',
            ),
            'nn' =>
            array (
            'iso_639_no' => 'nn',
            'Language name' => 'Norwegian Nynorsk',
            ),
            'no' =>
            array (
            'iso_639_no' => 'no',
            'Language name' => 'Norwegian',
            ),
            'nr' =>
            array (
            'iso_639_no' => 'nr',
            'Language name' => 'South Ndebele',
            ),
            'nv' =>
            array (
            'iso_639_no' => 'nv',
            'Language name' => 'Navajo, Navaho',
            ),
            'ny' =>
            array (
            'iso_639_no' => 'ny',
            'Language name' => 'Chichewa; Chewa; Nyanja',
            ),
            'oc' =>
            array (
            'iso_639_no' => 'oc',
            'Language name' => 'Occitan',
            ),
            'oj' =>
            array (
            'iso_639_no' => 'oj',
            'Language name' => 'Ojibwe, Ojibwa',
            ),
            'om' =>
            array (
            'iso_639_no' => 'om',
            'Language name' => 'Oromo',
            ),
            'or' =>
            array (
            'iso_639_no' => 'or',
            'Language name' => 'Oriya',
            ),
            'os' =>
            array (
            'iso_639_no' => 'os',
            'Language name' => 'Ossetian, Ossetic',
            ),
            'pa' =>
            array (
            'iso_639_no' => 'pa',
            'Language name' => 'Panjabi, Punjabi',
            ),
            'pi' =>
            array (
            'iso_639_no' => 'pi',
            'Language name' => 'Pāli',
            ),
            'pl' =>
            array (
            'iso_639_no' => 'pl',
            'Language name' => 'Polish',
            ),
            'ps' =>
            array (
            'iso_639_no' => 'ps',
            'Language name' => 'Pashto, Pushto',
            ),
            'pt' =>
            array (
            'iso_639_no' => 'pt',
            'Language name' => 'Portuguese',
            ),
            'qu' =>
            array (
            'iso_639_no' => 'qu',
            'Language name' => 'Quechua',
            ),
            'rm' =>
            array (
            'iso_639_no' => 'rm',
            'Language name' => 'Romansh',
            ),
            'rn' =>
            array (
            'iso_639_no' => 'rn',
            'Language name' => 'Kirundi',
            ),
            'ro' =>
            array (
            'iso_639_no' => 'ro',
            'Language name' => 'Romanian',
            ),
            'ru' =>
            array (
            'iso_639_no' => 'ru',
            'Language name' => 'Russian',
            ),
            'rw' =>
            array (
            'iso_639_no' => 'rw',
            'Language name' => 'Kinyarwanda',
            ),
            'sa' =>
            array (
            'iso_639_no' => 'sa',
            'Language name' => 'Sanskrit (Saṁskṛta)',
            ),
            'sc' =>
            array (
            'iso_639_no' => 'sc',
            'Language name' => 'Sardinian',
            ),
            'sd' =>
            array (
            'iso_639_no' => 'sd',
            'Language name' => 'Sindhi',
            ),
            'se' =>
            array (
            'iso_639_no' => 'se',
            'Language name' => 'Northern Sami',
            ),
            'sg' =>
            array (
            'iso_639_no' => 'sg',
            'Language name' => 'Sango',
            ),
            'si' =>
            array (
            'iso_639_no' => 'si',
            'Language name' => 'Sinhala, Sinhalese',
            ),
            'sk' =>
            array (
            'iso_639_no' => 'sk',
            'Language name' => 'Slovak',
            ),
            'sl' =>
            array (
            'iso_639_no' => 'sl',
            'Language name' => 'Slovene',
            ),
            'sm' =>
            array (
            'iso_639_no' => 'sm',
            'Language name' => 'Samoan',
            ),
            'sn' =>
            array (
            'iso_639_no' => 'sn',
            'Language name' => 'Shona',
            ),
            'so' =>
            array (
            'iso_639_no' => 'so',
            'Language name' => 'Somali',
            ),
            'sq' =>
            array (
            'iso_639_no' => 'sq',
            'Language name' => 'Albanian',
            ),
            'sr' =>
            array (
            'iso_639_no' => 'sr',
            'Language name' => 'Serbian',
            ),
            'ss' =>
            array (
            'iso_639_no' => 'ss',
            'Language name' => 'Swati',
            ),
            'st' =>
            array (
            'iso_639_no' => 'st',
            'Language name' => 'Southern Sotho',
            ),
            'su' =>
            array (
            'iso_639_no' => 'su',
            'Language name' => 'Sundanese',
            ),
            'sv' =>
            array (
            'iso_639_no' => 'sv',
            'Language name' => 'Swedish',
            ),
            'sw' =>
            array (
            'iso_639_no' => 'sw',
            'Language name' => 'Swahili',
            ),
            'ta' =>
            array (
            'iso_639_no' => 'ta',
            'Language name' => 'Tamil',
            ),
            'te' =>
            array (
            'iso_639_no' => 'te',
            'Language name' => 'Telugu',
            ),
            'tg' =>
            array (
            'iso_639_no' => 'tg',
            'Language name' => 'Tajik',
            ),
            'th' =>
            array (
            'iso_639_no' => 'th',
            'Language name' => 'Thai',
            ),
            'ti' =>
            array (
            'iso_639_no' => 'ti',
            'Language name' => 'Tigrinya',
            ),
            'tk' =>
            array (
            'iso_639_no' => 'tk',
            'Language name' => 'Turkmen',
            ),
            'tl' =>
            array (
            'iso_639_no' => 'tl',
            'Language name' => 'Tagalog',
            ),
            'tn' =>
            array (
            'iso_639_no' => 'tn',
            'Language name' => 'Tswana',
            ),
            'to' =>
            array (
            'iso_639_no' => 'to',
            'Language name' => 'Tonga (Tonga Islands)',
            ),
            'tr' =>
            array (
            'iso_639_no' => 'tr',
            'Language name' => 'Turkish',
            ),
            'ts' =>
            array (
            'iso_639_no' => 'ts',
            'Language name' => 'Tsonga',
            ),
            'tt' =>
            array (
            'iso_639_no' => 'tt',
            'Language name' => 'Tatar',
            ),
            'tw' =>
            array (
            'iso_639_no' => 'tw',
            'Language name' => 'Twi',
            ),
            'ty' =>
            array (
            'iso_639_no' => 'ty',
            'Language name' => 'Tahitian',
            ),
            'ug' =>
            array (
            'iso_639_no' => 'ug',
            'Language name' => 'Uyghur, Uighur',
            ),
            'uk' =>
            array (
            'iso_639_no' => 'uk',
            'Language name' => 'Ukrainian',
            ),
            'ur' =>
            array (
            'iso_639_no' => 'ur',
            'Language name' => 'Urdu',
            ),
            'uz' =>
            array (
            'iso_639_no' => 'uz',
            'Language name' => 'Uzbek',
            ),
            've' =>
            array (
            'iso_639_no' => 've',
            'Language name' => 'Venda',
            ),
            'vi' =>
            array (
            'iso_639_no' => 'vi',
            'Language name' => 'Vietnamese',
            ),
            'vo' =>
            array (
            'iso_639_no' => 'vo',
            'Language name' => 'Volapük',
            ),
            'wa' =>
            array (
            'iso_639_no' => 'wa',
            'Language name' => 'Walloon',
            ),
            'wo' =>
            array (
            'iso_639_no' => 'wo',
            'Language name' => 'Wolof',
            ),
            'xh' =>
            array (
            'iso_639_no' => 'xh',
            'Language name' => 'Xhosa',
            ),
            'yi' =>
            array (
            'iso_639_no' => 'yi',
            'Language name' => 'Yiddish',
            ),
            'yo' =>
            array (
            'iso_639_no' => 'yo',
            'Language name' => 'Yoruba',
            ),
            'za' =>
            array (
            'iso_639_no' => 'za',
            'Language name' => 'Zhuang, Chuang',
            ),
            'zh' =>
            array (
            'iso_639_no' => 'zh',
            'Language name' => 'Chinese',
            ),
            'zu' =>
            array (
            'iso_639_no' => 'zu',
            'Language name' => 'Zulu',
            ),
        );

        foreach($languages as $key => $language){
            Languages::updateOrCreate([
                'language_name' => $language['Language name']
            ],[
                'iso_639_no' => $language['iso_639_no']
            ]);
        }

    }
}
