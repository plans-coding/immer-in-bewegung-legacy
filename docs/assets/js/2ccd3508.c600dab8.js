"use strict";(self.webpackChunkbewegung=self.webpackChunkbewegung||[]).push([[991],{3831:(e,t,n)=>{n.r(t),n.d(t,{assets:()=>a,contentTitle:()=>d,default:()=>l,frontMatter:()=>s,metadata:()=>o,toc:()=>c});var r=n(4848),i=n(8453);const s={sidebar_position:3},d="Trip Map",o={id:"trip-syntax/trip-map",title:"Trip Map",description:"Create a sheet in your spreadsheet named Map with columns according to following.",source:"@site/docs/trip-syntax/trip-map.md",sourceDirName:"trip-syntax",slug:"/trip-syntax/trip-map",permalink:"/immer-in-bewegung/docs/trip-syntax/trip-map",draft:!1,unlisted:!1,editUrl:"https://github.com/plans-conding/immer-in-bewegung/docs/trip-syntax/trip-map.md",tags:[],version:"current",sidebarPosition:3,frontMatter:{sidebar_position:3},sidebar:"tutorialSidebar",previous:{title:"Trip Events",permalink:"/immer-in-bewegung/docs/trip-syntax/trip-events"},next:{title:"Appendix",permalink:"/immer-in-bewegung/docs/trip-syntax/appendix"}},a={},c=[];function h(e){const t={admonition:"admonition",code:"code",em:"em",h1:"h1",header:"header",p:"p",strong:"strong",table:"table",tbody:"tbody",td:"td",th:"th",thead:"thead",tr:"tr",...(0,i.R)(),...e.components};return(0,r.jsxs)(r.Fragment,{children:[(0,r.jsx)(t.header,{children:(0,r.jsx)(t.h1,{id:"trip-map",children:"Trip Map"})}),"\n",(0,r.jsxs)(t.p,{children:["Create a ",(0,r.jsx)(t.strong,{children:"sheet"})," in your ",(0,r.jsx)(t.strong,{children:"spreadsheet"})," named ",(0,r.jsx)(t.code,{children:"Map"})," with columns according to following."]}),"\n",(0,r.jsx)(t.admonition,{title:"Regarding sheet formula examples below",type:"info",children:(0,r.jsx)(t.p,{children:"All examples are for the second row in the sheet. For the subsequent rows the formula will customize automatically. The template is already prefilled."})}),"\n",(0,r.jsx)(t.admonition,{title:"Note",type:"warning",children:(0,r.jsx)(t.p,{children:"The order of the rows define the direction in which the route is drawn on the map."})}),"\n",(0,r.jsxs)(t.table,{children:[(0,r.jsx)(t.thead,{children:(0,r.jsxs)(t.tr,{children:[(0,r.jsx)(t.th,{}),(0,r.jsx)(t.th,{children:"Column Name"}),(0,r.jsx)(t.th,{children:"Needed for"}),(0,r.jsx)(t.th,{children:"Description"})]})}),(0,r.jsxs)(t.tbody,{children:[(0,r.jsxs)(t.tr,{children:[(0,r.jsx)(t.td,{children:"A"}),(0,r.jsx)(t.td,{children:"Type"}),(0,r.jsx)(t.td,{children:"Web app"}),(0,r.jsxs)(t.td,{children:["Use formula ",(0,r.jsx)(t.code,{children:'=IF(ISBLANK(B2);"";LEFT(B2))'}),"."]})]}),(0,r.jsxs)(t.tr,{children:[(0,r.jsx)(t.td,{children:"B"}),(0,r.jsx)(t.td,{children:"Cron"}),(0,r.jsx)(t.td,{children:"Web app"}),(0,r.jsxs)(t.td,{children:["The cronological reference is used to connect each sheet to each other. It consists of a letter and a number ",(0,r.jsx)(t.strong,{children:"without any dashes"})," or other characters. The letter specifies the Trip Type, e.g. ",(0,r.jsx)(t.strong,{children:"domestic"})," (I), ",(0,r.jsx)(t.strong,{children:"abroad"})," (U), or ",(0,r.jsx)(t.strong,{children:"attachment"})," (D) (see separate definition). The number is a chronological number, where the first trip in each letter category is marked as ",(0,r.jsx)(t.strong,{children:"1"}),". E.g. ",(0,r.jsx)(t.strong,{children:"U23"})," for abroad trip number 23.  ",(0,r.jsxs)(t.em,{children:["Use ",(0,r.jsx)(t.strong,{children:"X"})," if you want to exclude the row from the web app."]})]})]}),(0,r.jsxs)(t.tr,{children:[(0,r.jsx)(t.td,{children:"C"}),(0,r.jsx)(t.td,{children:"Pin Place"}),(0,r.jsx)(t.td,{children:"Web app"}),(0,r.jsxs)(t.td,{children:["The name of the place, e.g. ",(0,r.jsx)(t.strong,{children:"Stockholm"}),"."]})]}),(0,r.jsxs)(t.tr,{children:[(0,r.jsx)(t.td,{children:"D"}),(0,r.jsx)(t.td,{children:"Country"}),(0,r.jsx)(t.td,{children:"Spreadsheet only"}),(0,r.jsx)(t.td,{children:"Makes it easier when you read in a standalone spreadsheet."})]}),(0,r.jsxs)(t.tr,{children:[(0,r.jsx)(t.td,{children:"E"}),(0,r.jsx)(t.td,{children:"Coordinates"}),(0,r.jsx)(t.td,{children:"Web app"}),(0,r.jsxs)(t.td,{children:["The gps coordinates of your pin place in the format ",(0,r.jsx)(t.code,{children:"lat_decimal,lng_decimal"})," e.g. ",(0,r.jsx)(t.strong,{children:"59.329444, 18.068611"}),"."]})]}),(0,r.jsxs)(t.tr,{children:[(0,r.jsx)(t.td,{children:"F"}),(0,r.jsx)(t.td,{children:"FM"}),(0,r.jsx)(t.td,{children:"Spreadsheet only"}),(0,r.jsxs)(t.td,{children:["This column is only for row formatting and readability. ",(0,r.jsx)(t.code,{children:'=IF(A2="";"";IF(F1="FM";1;IF(B1=B2;F1;F1+1)))'})]})]})]})]})]})}function l(e={}){const{wrapper:t}={...(0,i.R)(),...e.components};return t?(0,r.jsx)(t,{...e,children:(0,r.jsx)(h,{...e})}):h(e)}},8453:(e,t,n)=>{n.d(t,{R:()=>d,x:()=>o});var r=n(6540);const i={},s=r.createContext(i);function d(e){const t=r.useContext(s);return r.useMemo((function(){return"function"==typeof e?e(t):{...t,...e}}),[t,e])}function o(e){let t;return t=e.disableParentContext?"function"==typeof e.components?e.components(i):e.components||i:d(e.components),r.createElement(s.Provider,{value:t},e.children)}}}]);