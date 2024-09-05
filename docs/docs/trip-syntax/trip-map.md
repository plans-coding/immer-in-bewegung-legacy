---
sidebar_position: 3
---

# Trip Map

Create a **sheet** in your **spreadsheet** named `Map` with columns according to following.

:::info[Regarding sheet formula examples below]
All examples are for the second row in the sheet. For the subsequent rows the formula will customize automatically. The template is already prefilled.
:::

:::warning[Note]
The order of the rows define the direction in which the route is drawn on the map.
:::

||Column Name|Needed for|Description|
|-|-|-|-|
|A|Type|Web app|Use formula `=IF(ISBLANK(B2);"";LEFT(B2))`.
|B|Cron|Web app|The cronological reference is used to connect each sheet to each other. It consists of a letter and a number **without any dashes** or other characters. The letter specifies the Trip Type, e.g. **domestic** (I), **abroad** (U), or **attachment** (D) (see separate definition). The number is a chronological number, where the first trip in each letter category is marked as **1**. E.g. **U23** for abroad trip number 23.  *Use **X** if you want to exclude the row from the web app.*
|C|Pin Place|Web app|The name of the place, e.g. **Stockholm**.
|D|Country|Spreadsheet only|Makes it easier when you read in a standalone spreadsheet.
|E|Coordinates|Web app|The gps coordinates of your pin place in the format `lat_decimal,lng_decimal` e.g. **59.329444, 18.068611**.
|F|FM|Spreadsheet only|This column is only for row formatting and readability. `=IF(A2="";"";IF(F1="FM";1;IF(B1=B2;F1;F1+1)))`
