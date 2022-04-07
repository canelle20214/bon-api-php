import Link from 'next/link';

const PanierArticle = ({quantite, plat, onRemove}) =>
{
    const prix = plat.prix.toFixed(2);
    return <li className="flex py-6">
      <div className="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
        <img src={plat.image} alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." className="h-full w-full object-cover object-center" />
      </div>
      <div className="ml-4 flex flex-1 flex-col">
        <div>
          <div className="flex justify-between text-base font-medium text-gray-900">
            <h3>
                <Link href={`/plats/${plat.id}`}>{plat.nom}</Link>
            </h3>
            <p className="ml-4">{prix}€</p>
          </div>
          <p className="mt-1 text-sm text-gray-500 line-clamp-2 text-ellipsis overflow-hidden ...">{plat.description}</p>
        </div>
        <div className="flex flex-1 items-end justify-between text-sm">
          <p className="text-gray-500">Qté {quantite}</p>
          <div className="flex">
            <button type="button" onClick={() => (onRemove(plat.id))} className="font-medium text-orange-500 hover:text-orange-400">Retirer</button>
          </div>
        </div>
      </div>
    </li>;
}

export default PanierArticle;