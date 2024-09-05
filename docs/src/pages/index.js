import clsx from 'clsx';
import Link from '@docusaurus/Link';
import useDocusaurusContext from '@docusaurus/useDocusaurusContext';
import Layout from '@theme/Layout';
import HomepageFeatures from '@site/src/components/HomepageFeatures';

import Heading from '@theme/Heading';
import styles from './index.module.css';

/*{siteConfig.title}*/
/*<span class="immer-in-font-uc">Immer in</span> <span class="bewegung-font-uc">Bewegung</span>*/
/*{siteConfig.tagline}*/

function HomepageHeader() {
  const {siteConfig} = useDocusaurusContext();
  return (
    <header className={clsx('hero hero--primary', styles.heroBanner)}>
      <div className="container">
        <Heading as="h1" className="hero__title">
          Revisit your travel memories
        </Heading>
        <p className="hero__subtitle">Open source travel documentation app for self-hosting<br /><b>Lightweight and future proof</b></p>
        <div className={styles.buttons}>
          <Link
            className="button button--secondary button--lg"
            to="/docs/intro">
            Start
          </Link>
        </div>
      </div>
    </header>
  );
}

export default function Home() {
  const {siteConfig} = useDocusaurusContext();
  return (
    <Layout
      title={`${siteConfig.title}`}
      description="Description will go into a meta tag in <head />">
      <HomepageHeader />
      <main>
      <div className={styles.imgScreenshotContainer}>
      <div className={styles.imgScreenshotL}><img src="img/screenshots/iib-overview.png"/></div>
      <div className={styles.imgScreenshotP}><img src="img/screenshots/iib-overview-mobile.jpg" /></div>
      <div className={styles.imgScreenshotL}><img src="img/screenshots/iib-events.png" /></div>
      </div>
      </main>
    </Layout>
  );
}
