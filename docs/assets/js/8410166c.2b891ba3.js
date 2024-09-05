"use strict";(self.webpackChunkbewegung=self.webpackChunkbewegung||[]).push([[616],{7630:(e,t,r)=>{r.r(t),r.d(t,{assets:()=>c,contentTitle:()=>d,default:()=>a,frontMatter:()=>i,metadata:()=>o,toc:()=>h});var n=r(4848),s=r(8453);const i={sidebar_position:2},d="Trip Overview",o={id:"trip-syntax/trip-overview",title:"Trip Overview",description:"Create a sheet in your spreadsheet named Overview with columns according to following.",source:"@site/docs/trip-syntax/trip-overview.md",sourceDirName:"trip-syntax",slug:"/trip-syntax/trip-overview",permalink:"/immer-in-bewegung/docs/trip-syntax/trip-overview",draft:!1,unlisted:!1,editUrl:"https://github.com/plans-conding/immer-in-bewegung/docs/trip-syntax/trip-overview.md",tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Trip Syntax",permalink:"/immer-in-bewegung/docs/category/trip-syntax"},next:{title:"Trip Events",permalink:"/immer-in-bewegung/docs/trip-syntax/trip-events"}},c={},h=[];function l(e){const t={a:"a",admonition:"admonition",code:"code",em:"em",h1:"h1",header:"header",p:"p",strong:"strong",table:"table",tbody:"tbody",td:"td",th:"th",thead:"thead",tr:"tr",...(0,s.R)(),...e.components};return(0,n.jsxs)(n.Fragment,{children:[(0,n.jsx)(t.header,{children:(0,n.jsx)(t.h1,{id:"trip-overview",children:"Trip Overview"})}),"\n",(0,n.jsxs)(t.p,{children:["Create a ",(0,n.jsx)(t.strong,{children:"sheet"})," in your ",(0,n.jsx)(t.strong,{children:"spreadsheet"})," named ",(0,n.jsx)(t.code,{children:"Overview"})," with columns according to following."]}),"\n",(0,n.jsx)(t.admonition,{title:"Regarding sheet formula examples below",type:"info",children:(0,n.jsx)(t.p,{children:"All examples are for the second row in the sheet. For the subsequent rows the formula will customize automatically. The template is already prefilled."})}),"\n",(0,n.jsxs)(t.table,{children:[(0,n.jsx)(t.thead,{children:(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.th,{}),(0,n.jsx)(t.th,{children:"Column"}),(0,n.jsx)(t.th,{children:"Needed for"}),(0,n.jsx)(t.th,{children:"Description"})]})}),(0,n.jsxs)(t.tbody,{children:[(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"A"}),(0,n.jsx)(t.td,{children:"Type"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["Use formula ",(0,n.jsx)(t.code,{children:'=IF(ISBLANK(B2);"";LEFT(B2))'}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"B"}),(0,n.jsx)(t.td,{children:"Cron"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["The cronological reference is used to connect each sheet to each other. It consists of a letter and a number ",(0,n.jsx)(t.strong,{children:"without any dashes"})," or other characters. The letter specifies the Trip Type, e.g. ",(0,n.jsx)(t.strong,{children:"domestic"})," (I), ",(0,n.jsx)(t.strong,{children:"abroad"})," (U), or ",(0,n.jsx)(t.strong,{children:"attachment"})," (D) (see separate definition). The number is a chronological number, where the first trip in each letter category is marked as ",(0,n.jsx)(t.strong,{children:"1"}),". E.g. ",(0,n.jsx)(t.strong,{children:"U23"})," for abroad trip number 23.  ",(0,n.jsxs)(t.em,{children:["Use ",(0,n.jsx)(t.strong,{children:"X"})," if you want to exclude the row from the web app."]})]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"C"}),(0,n.jsx)(t.td,{children:"Travel Group"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["Could e.g. be ",(0,n.jsx)(t.strong,{children:"Family"}),", ",(0,n.jsx)(t.strong,{children:"Private"}),", or ",(0,n.jsx)(t.strong,{children:"Work"}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"D"}),(0,n.jsx)(t.td,{children:"Ref-ID"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["The reference ID is exposed to end-user of the web app. It uses a letter and a index number ",(0,n.jsx)(t.strong,{children:"separated by dash"}),", where the letter is a abbreviation of the Travel Group and a chronological index number. E.g. ",(0,n.jsx)(t.strong,{children:"F-3"})," (family trip 3), ",(0,n.jsx)(t.strong,{children:"P-12"})," (private trip 12), or ",(0,n.jsx)(t.strong,{children:"W-4"})," (work trip 4)."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"E"}),(0,n.jsx)(t.td,{children:"Overall Destination"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["Typ in you trip primary desstination. E.g. ",(0,n.jsx)(t.strong,{children:"Finland"}),", or ",(0,n.jsx)(t.strong,{children:"Italia, Spain etc."})]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"F"}),(0,n.jsx)(t.td,{children:"Departure Date"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["Your departure date in ISO format ",(0,n.jsx)(t.code,{children:"YYYY-MM-DD"}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"G"}),(0,n.jsx)(t.td,{children:"Return Date"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["Your return date in ISO format ",(0,n.jsx)(t.code,{children:"YYYY-MM-DD"}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"H"}),(0,n.jsx)(t.td,{children:"Number of Days"}),(0,n.jsx)(t.td,{children:"Spreadsheet only"}),(0,n.jsxs)(t.td,{children:["This is actually calculated in the app, so the field can be left empty. But for convinience when reading the spreadsheet standalone this is inserted. You can use formula in Google sheet ",(0,n.jsx)(t.code,{children:'=IF(IFERROR(DATEDIF(F2;G2;"D");0)=0;"";DATEDIF(F2;G2;"D"))'}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"I"}),(0,n.jsx)(t.td,{children:"Country Trip Movements"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["The trip nodes shown as text (this does not affect the map). Formula ",(0,n.jsx)(t.code,{children:'=IFERROR(IF(TEXTJOIN("}, {";TRUE;QUERY(Map!A:F;"select C where B = \'"&B2&"\'";0))="";"";"{"&TEXTJOIN("}, {";TRUE;QUERY(Map!A:F;"select C where B = \'"&B2&"\'";0))&"}");"")'}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"J"}),(0,n.jsx)(t.td,{children:"Trip Description"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["A short description that explain the aim of the trip. E.g. ",(0,n.jsx)(t.strong,{children:"My fantastic summer trip to France"}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"K"}),(0,n.jsx)(t.td,{children:"Country Trip Movements"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:["Enter the countries you have visited on the trip. ",(0,n.jsx)(t.em,{children:"This is not used for statistics, see Trip Events for statistic purposes."})," The syntax is ",(0,n.jsx)(t.code,{children:"{Node}, Country-A, Country-B, **Country-C, *Country-D, {Node}"}),". Read more about the prefixes (",(0,n.jsx)(t.code,{children:"*"}),", ",(0,n.jsx)(t.code,{children:"**"}),", and ",(0,n.jsx)(t.code,{children:"+"}),") under ",(0,n.jsx)(t.a,{href:"./appendix",children:"Appendix"}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"L"}),(0,n.jsx)(t.td,{children:"Photo Starttime"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:[(0,n.jsx)(t.em,{children:"For use with Immich."})," If you leave your home at let say 8 pm and don't want to include photos from earlier on ",(0,n.jsx)(t.strong,{children:"departure day"}),", then you can set a time here. If left empty, all photos from departure day will be included."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"M"}),(0,n.jsx)(t.td,{children:"Photo Endtime"}),(0,n.jsx)(t.td,{children:"Web app"}),(0,n.jsxs)(t.td,{children:[(0,n.jsx)(t.em,{children:"For use with Immich."})," Same as above, but for ",(0,n.jsx)(t.strong,{children:"return day"}),"."]})]}),(0,n.jsxs)(t.tr,{children:[(0,n.jsx)(t.td,{children:"N"}),(0,n.jsx)(t.td,{children:"FM"}),(0,n.jsx)(t.td,{children:"Spreadsheet only"}),(0,n.jsxs)(t.td,{children:["This column is only for row formatting and readability. ",(0,n.jsx)(t.code,{children:'=IF(A2="";"";IF(N1="FM";1;IF(A1=A2;N1;N1+1)))'})]})]})]})]})]})}function a(e={}){const{wrapper:t}={...(0,s.R)(),...e.components};return t?(0,n.jsx)(t,{...e,children:(0,n.jsx)(l,{...e})}):l(e)}},8453:(e,t,r)=>{r.d(t,{R:()=>d,x:()=>o});var n=r(6540);const s={},i=n.createContext(s);function d(e){const t=n.useContext(i);return n.useMemo((function(){return"function"==typeof e?e(t):{...t,...e}}),[t,e])}function o(e){let t;return t=e.disableParentContext?"function"==typeof e.components?e.components(s):e.components||s:d(e.components),n.createElement(i.Provider,{value:t},e.children)}}}]);