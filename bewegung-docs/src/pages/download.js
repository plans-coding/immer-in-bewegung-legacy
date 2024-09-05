import clsx from 'clsx';
import Link from '@docusaurus/Link';
import useDocusaurusContext from '@docusaurus/useDocusaurusContext';
import Layout from '@theme/Layout';
import HomepageFeatures from '@site/src/components/HomepageFeatures';

import Heading from '@theme/Heading';
import styles from './index.module.css';


function HomepageHeader() {
  const {siteConfig} = useDocusaurusContext();
  return (
    <header className={clsx('hero hero--primary', styles.downloadBanner)}>
      <div className="container">
        <Heading as="h1" className="hero__title">
          Download
        </Heading>
        <p className="hero__subtitle">Start documenting your travels now</p>
        <div className={styles.buttons}>
          <Link
            className="button button--secondary button--lg"
            to="/docs/intro">
            Download latest version for Docker installation (zip)
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
      <div className={styles.imgScreenshotL}><img src="img/screenshots/iib-immich.png"></img></div>
      <div className={styles.imgScreenshotL}><img src="img/screenshots/iib-map.png"></img></div>
      <div className={styles.imgScreenshotL}><img src="img/screenshots/iib-stats.png"></img></div>
      </div>
      </main>
    </Layout>
  );
}
