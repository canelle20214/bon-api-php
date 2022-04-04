import '../styles/globals.css'
import Head from "next/head";

function MyApp({Component, pageProps}) {
    return (
        <>
            <Head>
                <title>Bon API - Vietnamese food</title>
                <meta name="description" content="Bon API Vietnamese food"/>
                <link rel="icon" href="./ant-favicon.jpg"/>
            </Head>
            <Component {...pageProps} />
        </>
    )
}

export default MyApp;
