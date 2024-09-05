---
sidebar_position: 5
---

# Further settings

An attachment trip is defined as a visit to a country where you have a deeper connection. For example, if you study abroad, you might want to document that time but distinguish it from the ordinary abroad or domestic category.

## Make other country definitions

If you want to change the pre-defined country settings you can do it by changing in the country definitions.

:::tip[Other language]
This is also usable if you have the countries in your spreadsheet written in another languange than English, then you can change by translating the countries below to your own language.
:::

```text title="/etc/bewegung/iib-settings.yaml"

### Change this only if you want change country definitions
countries:
  - continent: Europe
    continent-countries:
      - Albania
      - Andorra
      - Austria
      - Belarus
      - Belgium
      - Bosnia and Herzegovina
      - Bulgaria
      - Croatia
      - Cyprus
      - Czech Republic
      - Denmark
      - Estonia
      - Finland
      - Finland-Åland
      - France
      - Georgia
      - Germany
      - Greece
      - Hungary
      - Iceland
      - Ireland
      - Italy
      - Kosovo
      - Latvia
      - Liechtenstein
      - Lithuania
      - Luxembourg
      - Malta
      - Moldova
      - Moldova-Transnistria
      - Monaco
      - Montenegro
      - Netherlands
      - North Macedonia
      - Norway
      - Poland
      - Portugal
      - Romania
      - Russia
      - San Marino
      - Serbia
      - Slovakia
      - Slovenia
      - Spain
      - Sweden
      - Switzerland
      - Ukraine
      - United Kingdom
      - United Kingdom-Akrotiri and Dhekelia
      - United Kingdom-Gibraltar
      - United Kingdom-Jersey
      - Vatican City

  - continent: Asia
    continent-countries:
      - Afghanistan
      - Armenia
      - Azerbaijan
      - Bahrain
      - Bangladesh
      - Bhutan
      - Brunei
      - Cambodia
      - China
      - Cyprus
      - Georgia
      - India
      - Indonesia
      - Iran
      - Iraq
      - Israel
      - Japan
      - Jordan
      - Kazakhstan
      - Kuwait
      - Kyrgyzstan
      - Laos
      - Lebanon
      - Malaysia
      - Maldives
      - Mongolia
      - Myanmar
      - Nepal
      - North Korea
      - Oman
      - Pakistan
      - Philippines
      - Qatar
      - Russia
      - Saudi Arabia
      - Singapore
      - South Korea
      - Sri Lanka
      - Syria
      - Taiwan
      - Tajikistan
      - Thailand
      - Timor-Leste
      - Turkey
      - Turkmenistan
      - United Arab Emirates
      - Uzbekistan
      - Vietnam
      - Yemen

  - continent: North America
    continent-countries:
      - Antigua and Barbuda
      - Bahamas
      - Barbados
      - Belize
      - Canada
      - Costa Rica
      - Cuba
      - Dominica
      - Dominican Republic
      - El Salvador
      - Grenada
      - Guatemala
      - Haiti
      - Honduras
      - Jamaica
      - Mexico
      - Nicaragua
      - Panama
      - Saint Kitts and Nevis
      - Saint Lucia
      - Saint Vincent and the Grenadines
      - Trinidad and Tobago
      - United States

  - continent: South America
    continent-countries:
      - Argentina
      - Bolivia
      - Brazil
      - Chile
      - Colombia
      - Ecuador
      - Guyana
      - Paraguay
      - Peru
      - Suriname
      - Uruguay
      - Venezuela

  - continent: Africa
    continent-countries:
      - Algeria
      - Angola
      - Benin
      - Botswana
      - Burkina Faso
      - Burundi
      - Cabo Verde
      - Cameroon
      - Central African Republic
      - Chad
      - Comoros
      - Democratic Republic of the Congo
      - Djibouti
      - Egypt
      - Equatorial Guinea
      - Eritrea
      - Eswatini
      - Ethiopia
      - Gabon
      - Gambia
      - Ghana
      - Guinea
      - Guinea-Bissau
      - Ivory Coast
      - Kenya
      - Lesotho
      - Liberia
      - Libya
      - Madagascar
      - Malawi
      - Mali
      - Mauritania
      - Mauritius
      - Morocco
      - Mozambique
      - Namibia
      - Niger
      - Nigeria
      - Republic of the Congo
      - Rwanda
      - Sao Tome and Principe
      - Senegal
      - Seychelles
      - Sierra Leone
      - Somalia
      - South Africa
      - South Sudan
      - Sudan
      - Tanzania
      - Togo
      - Tunisia
      - Uganda
      - Zambia
      - Zimbabwe

  - continent: Oceania
    continent-countries:
      - Australia
      - Fiji
      - Kiribati
      - Marshall Islands
      - Micronesia
      - Nauru
      - New Zealand
      - Palau
      - Papua New Guinea
      - Samoa
      - Solomon Islands
      - Tonga
      - Tuvalu
      - Vanuatu

```

## Use other names on sheet columns
:::danger[Beware]
Only do this if you understand what you do.
:::
If you want to use other names in your spreadsheet, it is possible to do so by changing the mapping in the end of the file `iib-settings.yml`.