"use strict";(self.webpackChunkbewegung=self.webpackChunkbewegung||[]).push([[803],{6845:(e,n,t)=>{t.r(n),t.d(n,{assets:()=>d,contentTitle:()=>a,default:()=>h,frontMatter:()=>s,metadata:()=>o,toc:()=>l});var i=t(4848),r=t(8453);const s={sidebar_position:2},a="Installation",o={id:"installation",title:"Installation",description:"Using Docker (Recommended)",source:"@site/docs/installation.md",sourceDirName:".",slug:"/installation",permalink:"/docs/installation",draft:!1,unlisted:!1,tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Introduction",permalink:"/docs/intro"},next:{title:"Create the dataset",permalink:"/docs/create-dataset"}},d={},l=[{value:"Using Docker (Recommended)",id:"using-docker-recommended",level:2},{value:"Step 1 \u2212 Download files",id:"step-1--download-files",level:3},{value:"Step 2 \u2212 Unpack and run docker container",id:"step-2--unpack-and-run-docker-container",level:3},{value:"Step 3 \u2212 Edit settings file",id:"step-3--edit-settings-file",level:3},{value:"Step 4 \u2212 Save trip data from data set",id:"step-4--save-trip-data-from-data-set",level:3},{value:"Step 5 \u2212 Test you installation",id:"step-5--test-you-installation",level:3},{value:"Install on bare metal",id:"install-on-bare-metal",level:2}];function c(e){const n={a:"a",admonition:"admonition",code:"code",h1:"h1",h2:"h2",h3:"h3",header:"header",li:"li",p:"p",pre:"pre",strong:"strong",ul:"ul",...(0,r.R)(),...e.components};return(0,i.jsxs)(i.Fragment,{children:[(0,i.jsx)(n.header,{children:(0,i.jsx)(n.h1,{id:"installation",children:"Installation"})}),"\n",(0,i.jsx)(n.h2,{id:"using-docker-recommended",children:"Using Docker (Recommended)"}),"\n",(0,i.jsx)(n.h3,{id:"step-1--download-files",children:"Step 1 \u2212 Download files"}),"\n",(0,i.jsxs)(n.p,{children:["Download the ",(0,i.jsx)(n.a,{href:"https://github.com/plans-coding/immer-in-bewegung/releases/",children:"latest release"})," and save the tar.gz file to your home directory"]}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{children:"# Go to your home directory\ncd\n\n# Change x.x.x to the current version number\nwget https://github.com/plans-coding/immer-in-bewegung/archive/refs/tags/vx.x.x.tar.gz\n"})}),"\n",(0,i.jsx)(n.h3,{id:"step-2--unpack-and-run-docker-container",children:"Step 2 \u2212 Unpack and run docker container"}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{children:"# Unpack the archive (change x.x.x to the current version number)\ntar -xzvf vx.x.x.tar.gz --strip-components=1 immer-in-bewegung-1.0.0/bewegung-app\n\n# Go to the directory\ncd bewegung-app\n\n# Initiate your Docker container\nsudo docker compose up -d\n\n# Stop your Docker container (only use this if you want to cancel)\nsudo docker compose down\n"})}),"\n",(0,i.jsx)(n.h3,{id:"step-3--edit-settings-file",children:"Step 3 \u2212 Edit settings file"}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{className:"language-text",metastring:'title="nano edit bewegung/iib-settings.yaml"',children:"### Add your data source\ntrip-data:\n  - provider: google-sheet\n    spreadsheet-id: ENTER-YOUR-GOOGLE-SPREADSHEET-ID #<-----\n    spreadsheet-name: ENTER-YOUR-GOOGLE-SPREADSHEET-NAME #<-----\n    overview-name: Overview\n    overview-gid: ENTER-OVERVIEW-GID #<-----\n    events-name: Events\n    events-gid: ENTER-EVENTS-GID #<-----\n    map-name: Map\n    map-gid: ENTER-MAP-GID #<-----\n\n### Change Immich settings\nimmich-settings:\n  - immich-server-address: http://127.0.0.1:2283/ # Remember last dash /\n"})}),"\n",(0,i.jsx)(n.h3,{id:"step-4--save-trip-data-from-data-set",children:"Step 4 \u2212 Save trip data from data set"}),"\n",(0,i.jsxs)(n.p,{children:["Save your ",(0,i.jsx)(n.strong,{children:"three sheets"})," in ",(0,i.jsx)(n.strong,{children:"tsv"})," format to"]}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{children:"bewegung-app/www/data/\n"})}),"\n",(0,i.jsxs)(n.p,{children:["Read more under ",(0,i.jsx)(n.a,{href:"./create-dataset",children:"Create the dataset"}),"."]}),"\n",(0,i.jsx)(n.h3,{id:"step-5--test-you-installation",children:"Step 5 \u2212 Test you installation"}),"\n",(0,i.jsx)(n.p,{children:"Your instance is now reachable at"}),"\n",(0,i.jsx)(n.p,{children:(0,i.jsx)(n.a,{href:"http://localhost:2024/",children:"http://localhost:2024/"})}),"\n",(0,i.jsx)(n.h2,{id:"install-on-bare-metal",children:"Install on bare metal"}),"\n",(0,i.jsxs)(n.ul,{children:["\n",(0,i.jsx)(n.li,{children:"Install a webserver (Nginx or Apache with PHP 8.2)"}),"\n",(0,i.jsx)(n.li,{children:"Install yaml for php (sudo apt-get install php-yaml)"}),"\n",(0,i.jsxs)(n.li,{children:["Deploy the files from ",(0,i.jsx)(n.strong,{children:"bewegung-app"})," folder"]}),"\n"]}),"\n",(0,i.jsx)(n.admonition,{title:"USER AUTHENTICATION",type:"danger",children:(0,i.jsxs)(n.p,{children:["Make sure not to expose your files to the web directly without proper user authentication, Read more under ",(0,i.jsx)(n.a,{href:"other-needs",children:"Other needs"})]})})]})}function h(e={}){const{wrapper:n}={...(0,r.R)(),...e.components};return n?(0,i.jsx)(n,{...e,children:(0,i.jsx)(c,{...e})}):c(e)}},8453:(e,n,t)=>{t.d(n,{R:()=>a,x:()=>o});var i=t(6540);const r={},s=i.createContext(r);function a(e){const n=i.useContext(s);return i.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function o(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(r):e.components||r:a(e.components),i.createElement(s.Provider,{value:n},e.children)}}}]);