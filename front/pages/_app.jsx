import '../styles/globals.css'
import Head from "next/head";
import {Provider as BonApiContext} from '../contexts/BonApiContext';

function MyApp({Component, pageProps}) {
    return (
        <BonApiContext>
            <Head>
                <title>Bon API - Cambodian food</title>
                <meta name="description" content="Bon API Vietnamese food"/>
                <link rel="icon" href="./ant-favicon.jpg"/>
            </Head>
            <Component {...pageProps} />
        </BonApiContext>
    )
}

export default MyApp;
