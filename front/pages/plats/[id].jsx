import {ClientHeader, PlatDetails} from '../../components';
import {useRouter} from 'next/router';
import {useContext} from 'react';
import BonApiContext from '../../contexts/BonApiContext';

const Plats = () => 
{
    const {plats} = useContext(BonApiContext);
    const router = useRouter();
    const {id} = router.query;
    const plat = plats.find((e) => (e.id == id));
    const html = "ERREUR 404 : la page n'a pas été trouvée.";
    if(plat != undefined){
        html = <PlatDetails {...plat}/>;
    }
  return <>
    <ClientHeader/>
    {html}
  </>
}

export default Plats;
