import {ClientHeader, Panier} from '../../components';
import {useContext} from 'react';
import BonApiContext from '../../contexts/BonApiContext';
import {useState, useEffect} from 'react';

const Plats = () => 
{
    const {plats} = useContext(BonApiContext);
    const [panier, setPanier] = useState([]);
    
    const html = "Aucun article n'a été ajouté à votre panier pour le moment.";
    
    useEffect(() => {
        const p = JSON.parse(localStorage.getItem(`panier`) || []).map(({nb_plat, plat_id}) => {
            const plat = plats.find((e) => (e.id == plat_id));
            return {quantite: nb_plat, plat: plat};
        });
        setPanier(p);
    }, [])

    function removeFromShoppingCart(id){
        const store = JSON.parse(localStorage.getItem(`panier`) || []);
        const new_panier = store.filter(e => e.plat_id !== id);
        localStorage.setItem(`panier`, JSON.stringify(new_panier));
        setPanier(new_panier);
    }

    
    if(panier.length > 0){
        html = <Panier panier={panier} onRemove={removeFromShoppingCart}/>;
    }

  return <>
    <ClientHeader/>
    {html}
  </>
}

export default Plats;
