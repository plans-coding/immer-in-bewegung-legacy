"use strict";(self.webpackChunkbewegung=self.webpackChunkbewegung||[]).push([[803],{6845:(e,n,t)=>{t.r(n),t.d(n,{assets:()=>l,contentTitle:()=>a,default:()=>h,frontMatter:()=>i,metadata:()=>o,toc:()=>d});var r=t(4848),s=t(8453);const i={sidebar_position:2},a="Installation",o={id:"installation",title:"Installation",description:"Using Docker (Recommended)",source:"@site/docs/installation.md",sourceDirName:".",slug:"/installation",permalink:"/docs/installation",draft:!1,unlisted:!1,tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Introduction",permalink:"/docs/intro"},next:{title:"Create the dataset",permalink:"/docs/create-dataset"}},l={},d=[{value:"Using Docker (Recommended)",id:"using-docker-recommended",level:2},{value:"Install on bare metal",id:"install-on-bare-metal",level:2}];function c(e){const n={a:"a",code:"code",em:"em",h1:"h1",h2:"h2",header:"header",li:"li",p:"p",pre:"pre",strong:"strong",ul:"ul",...(0,s.R)(),...e.components};return(0,r.jsxs)(r.Fragment,{children:[(0,r.jsx)(n.header,{children:(0,r.jsx)(n.h1,{id:"installation",children:"Installation"})}),"\n",(0,r.jsx)(n.h2,{id:"using-docker-recommended",children:"Using Docker (Recommended)"}),"\n",(0,r.jsx)(n.p,{children:(0,r.jsx)(n.strong,{children:"Step 1 \u2212 Download files"})}),"\n",(0,r.jsxs)(n.p,{children:["Download all files from folder ",(0,r.jsx)(n.em,{children:"bewegung-app"})," or download the release file."]}),"\n",(0,r.jsx)(n.p,{children:(0,r.jsx)(n.strong,{children:"Step 2 \u2212 Unpack and run docker container"})}),"\n",(0,r.jsx)(n.pre,{children:(0,r.jsx)(n.code,{children:"# Go to your home directory\ncd\n\n# Download and unzip the archive\nwget\nunzip bewegung\nmkdir bewegung\n\n# Go to the directory\ncd bewegung\n\n# Initiate your Docker container\nsudo docker compose up -d\n"})}),"\n",(0,r.jsx)(n.p,{children:(0,r.jsx)(n.strong,{children:"Step 3 \u2212 Edit settings file"})}),"\n",(0,r.jsx)(n.pre,{children:(0,r.jsx)(n.code,{className:"language-text",metastring:'title="nano edit bewegung/iib-settings.yaml"',children:"### Add your data source\ntrip-data:\n  - provider: google-sheet\n    spreadsheet-id: ENTER-YOUR-GOOGLE-SPREADSHEET-ID #<-----\n    spreadsheet-name: ENTER-YOUR-GOOGLE-SPREADSHEET-NAME #<-----\n    overview-name: Overview\n    overview-gid: ENTER-OVERVIEW-GID #<-----\n    events-name: Events\n    events-gid: ENTER-EVENTS-GID #<-----\n    map-name: Map\n    map-gid: ENTER-MAP-GID #<-----\n\n### Change Immich settings\nimmich-settings:\n  - immich-server-address: http://127.0.0.1:2283/ # Remember last dash /\n"})}),"\n",(0,r.jsx)(n.p,{children:(0,r.jsx)(n.strong,{children:"Step 4 \u2212 Save trip data from data set"})}),"\n",(0,r.jsxs)(n.p,{children:["Save your three sheets in tsv format to ",(0,r.jsx)(n.code,{children:"bewegung/www/data/"}),". Read more under ",(0,r.jsx)(n.a,{href:"./create-dataset",children:"Create the dataset"}),"."]}),"\n",(0,r.jsx)(n.p,{children:(0,r.jsx)(n.strong,{children:"Step 5 \u2212 Test you installation"})}),"\n",(0,r.jsx)(n.p,{children:"Your instance is not reachable at"}),"\n",(0,r.jsx)(n.p,{children:(0,r.jsx)(n.a,{href:"http://localhost:2024/",children:"http://localhost:2024/"})}),"\n",(0,r.jsx)(n.h2,{id:"install-on-bare-metal",children:"Install on bare metal"}),"\n",(0,r.jsxs)(n.ul,{children:["\n",(0,r.jsx)(n.li,{children:"Install a webserver (Nginx or Apache with PHP)"}),"\n",(0,r.jsx)(n.li,{children:"Install yaml for php (sudo apt-get install php-yaml)"}),"\n"]})]})}function h(e={}){const{wrapper:n}={...(0,s.R)(),...e.components};return n?(0,r.jsx)(n,{...e,children:(0,r.jsx)(c,{...e})}):c(e)}},8453:(e,n,t)=>{t.d(n,{R:()=>a,x:()=>o});var r=t(6540);const s={},i=r.createContext(s);function a(e){const n=r.useContext(i);return r.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function o(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(s):e.components||s:a(e.components),r.createElement(i.Provider,{value:n},e.children)}}}]);