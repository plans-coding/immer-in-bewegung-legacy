// @ts-check
// `@type` JSDoc annotations allow editor autocompletion and type checking
// (when paired with `@ts-check`).
// There are various equivalent ways to declare your Docusaurus config.
// See: https://docusaurus.io/docs/api/docusaurus-config

import {themes as prismThemes} from 'prism-react-renderer';

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: 'Immer in Bewegung',
  tagline: 'Revisit your travel memories',
  favicon: 'img/frog_g_64.webp',

  // Set the production url of your site here
  url: 'https://bewegung.app',
  // Set the /bewegung-docs/ pathname under which your site is served
  // For GitHub pages deployment, it is often '/<projectName>/'
  baseUrl: '/bewegung-docs/',

  // GitHub pages deployment config.
  // If you aren't using GitHub pages, you don't need these.
  organizationName: 'plans-coding', // Usually your GitHub org/user name.
  projectName: 'immer-in-bewegung', // Usually your repo name.

  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',

  // Even if you don't use internationalization, you can use this field to set
  // useful metadata like html lang. For example, if your site is Chinese, you
  // may want to replace "en" with "zh-Hans".
  i18n: {
    defaultLocale: 'en',
    locales: ['en'],
  },

  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: './sidebars.js',
          // Please change this to your repo.
          // Remove this to remove the "edit this page" links.
          editUrl:
            'https://github.com/plans-coding/immer-in-bewegung/blob/main/bewegung-docs/',
        },
        /*blog: {
          showReadingTime: true,
          feedOptions: {
            type: ['rss', 'atom'],
            xslt: true,
          },
          // Please change this to your repo.
          // Remove this to remove the "edit this page" links.
          editUrl:
            'https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/',
          // Useful options to enforce blogging best practices
          onInlineTags: 'warn',
          onInlineAuthors: 'warn',
          onUntruncatedBlogPosts: 'warn',
        },*/
        theme: {
          customCss: './src/css/custom.css',
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      // Replace with your project's social card
      image: 'img/docusaurus-social-card.jpg',
      navbar: {
        title: 'Immer in Bewegung Documentation',
        logo: {
          alt: 'IIB Logo',
          src: 'img/frog_g_64.webp',
        },
        items: [
          {
            type: 'docSidebar',
            sidebarId: 'tutorialSidebar',
            position: 'left',
            label: 'Docs',
          },
          //{to: '/blog', label: 'Blog', position: 'left'},
          {to: '/download', label: 'Download', position: 'left'},
          {
            href: 'https://github.com/plans-coding',
            label: 'GitHub',
            position: 'right',
          },
        ],
      },
      footer: {
        copyright: `<div style="display:flex;align-items: center; justify-content: center;gap:5pt;"><div style="padding-top:8pt;"><img src="/img/frog_g_64.webp" /></div><div style="line-height:20pt;"><span class="immer-in-font-uc font-1-5">Immer in</span> <span class="bewegung-font-uc font-1-5">Bewegung</span> <br /> Revisit your travel memories</div></div>`,
      },
      prism: {
        theme: prismThemes.github,
        darkTheme: prismThemes.dracula,
      },
    }),
};

export default config;
