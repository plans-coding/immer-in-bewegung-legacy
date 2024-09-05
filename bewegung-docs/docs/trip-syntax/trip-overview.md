---
sidebar_position: 2
---

# Trip Overview

Create a **sheet** in your **spreadsheet** named `Overview` with columns according to following.

:::info[Regarding sheet formula examples below]
All examples are for the second row in the sheet. For the subsequent rows the formula will customize automatically. The template is already prefilled.
:::

||Column|Needed for|Description|
|-|-|-|-|
|A|Type|Web app|Use formula `=IF(ISBLANK(B2);"";LEFT(B2))`.
|B|Cron|Web app|The cronological reference is used to connect each sheet to each other. It consists of a letter and a number **without any dashes** or other characters. The letter specifies the Trip Type, e.g. **domestic** (I), **abroad** (U), or **attachment** (D) (see separate definition). The number is a chronological number, where the first trip in each letter category is marked as **1**. E.g. **U23** for abroad trip number 23.  *Use **X** if you want to exclude the row from the web app.*
|C|Travel Group|Web app|Could e.g. be **Family**, **Private**, or **Work**.
|D|Ref-ID|Web app|The reference ID is exposed to end-user of the web app. It uses a letter and a index number **separated by dash**, where the letter is a abbreviation of the Travel Group and a chronological index number. E.g. **F-3** (family trip 3), **P-12** (private trip 12), or **W-4** (work trip 4).
|E|Overall Destination|Web app|Typ in you trip primary desstination. E.g. **Finland**, or **Italia, Spain etc.**
|F|Departure Date|Web app|Your departure date in ISO format `YYYY-MM-DD`.
|G|Return Date|Web app|Your return date in ISO format `YYYY-MM-DD`.
|H|Number of Days|Spreadsheet only|This is actually calculated in the app, so the field can be left empty. But for convinience when reading the spreadsheet standalone this is inserted. You can use formula in Google sheet `=IF(IFERROR(DATEDIF(F2;G2;"D");0)=0;"";DATEDIF(F2;G2;"D"))`.
|I|Country Trip Movements|Web app|The trip nodes shown as text (this does not affect the map). Formula `=IFERROR(IF(TEXTJOIN("}, {";TRUE;QUERY(Map!A:F;"select C where B = '"&B2&"'";0))="";"";"{"&TEXTJOIN("}, {";TRUE;QUERY(Map!A:F;"select C where B = '"&B2&"'";0))&"}");"")`.
|J|Trip Description|Web app|A short description that explain the aim of the trip. E.g. **My fantastic summer trip to France**.
|K|Country Trip Movements|Web app|Enter the countries you have visited on the trip. *This is not used for statistics, see Trip Events for statistic purposes.* The syntax is `{Node}, Country-A, Country-B, **Country-C, *Country-D, {Node}`. Read more about the prefixes (`*`, `**`, and `+`) under [Appendix](./appendix).
|L|Photo Starttime|Web app|*For use with Immich.* If you leave your home at let say 8 pm and don't want to include photos from earlier on **departure day**, then you can set a time here. If left empty, all photos from departure day will be included.
|M|Photo Endtime|Web app|*For use with Immich.* Same as above, but for **return day**.
|N|FM|Spreadsheet only|This column is only for row formatting and readability. `=IF(A2="";"";IF(N1="FM";1;IF(A1=A2;N1;N1+1)))`


