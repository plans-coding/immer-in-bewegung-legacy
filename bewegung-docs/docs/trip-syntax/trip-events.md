---
sidebar_position: 3
---

# Trip Events
Create a **sheet** in your **spreadsheet** named `Events` with columns according to following.

:::info[Regarding sheet formula examples below]
All examples are for the second row in the sheet. For the subsequent rows the formula will customize automatically. The template is already prefilled.
:::

||Column Name|Needed for|Description|
|:-:|-|-|-|
|A|Type|Web app|Use formula `=IF(ISBLANK(B2);"";LEFT(B2))`.
|B|Cron|Web app|The cronological reference is used to connect each sheet to each other. It consists of a letter and a number **without any dashes** or other characters. The letter specifies the Trip Type, e.g. **domestic** (I), **abroad** (U), or **attachment** (D) (see separate definition). The number is a chronological number, where the first trip in each letter category is marked as **1**. E.g. **U23** for abroad trip number 23.  *Use **X** if you want to exclude the row from the web app.*
|C|Overall Destination|Web app|You can fill this with the value from `Overview` sheet. `=IFNA(IF(ISBLANK(VLOOKUP(B2;Overview!B:E;4;FALSE));"### Not defined ###";VLOOKUP(B2;Overview!B:E;4;FALSE));"")`
|D|Help Text|Spreadsheet only|This is not used in web app, but used for convenience to read the table standalone. Use formula `=IF(ISBLANK(E2);"";"V. "&WEEKNUM(E2;21)&" ")&IF(ISBLANK(E2);"";PROPER(TEXT(E2;"dddd")))`
|E|Date|Web app|Your date in ISO format `YYYY-MM-DD`.
|F|Events|Web app|This is your fully description of what you did this day.
|G|Accommodation|Web app|The name and the address of your accommodation.
|H|Accommodation Country|Web app|The name of the country you stayed in during the night.
|I|Accommodation Coordinates|Web app|The gps coordinates of your accommodation in the format `lat_decimal,lng_decimal` e.g. **59.329444, 18.068611**.
|J|Travel Group|Web app|You can fill this with the value from `Overview` sheet. `=IFNA(IF(ISBLANK(VLOOKUP(B2;Overview!B:C;2;FALSE));"### Not defined ###";VLOOKUP(B2;Overview!B:C;2;FALSE));"")`
|K|Travel Participants|Spreadsheet only|The name of your travel buddies, separated by comma. **N.B.** *Not exposured in web app.*
|L|Additional Notes|Spreadsheet only|**N.B.** *Additional notes not exposured in web app.*
|M|Countries During Day|Web app|This field is for enhanced statistics. Enter all countries in cronologial order during that day, separated by comma. The country names need to conform to the country names defined in `settings.yaml`. In front of the country name prefix `*`, `**`, and `+` is allowed.
|N|FM|Spreadsheet only|This column is only for row formatting and readability.`=IF(A2="";"";IF(N1="FM";1;IF(B1=B2;N1;N1+1)))`