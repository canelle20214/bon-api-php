import BonApiContext from '../../contexts/BonApiContext';
import {useContext} from 'react';
import {Plat} from '../../components';

const Plats = ({titre}) =>
{
    const {plats} = useContext(BonApiContext);
    const html = "Aucun plat n'est disponible pour le moment.";
    if (plats.length > 0){
        html = plats.map((e, i) => <Plat {...e} />)
    }
    console.log(html, "html");
    console.log(plats, "plats");
    return <div className="bg-white">
  <div className="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 className="text-2xl font-extrabold tracking-tight text-gray-900">{titre}</h2>
    <div className="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
      {html}
    </div>
  </div>
</div>;
}

export default Plats;