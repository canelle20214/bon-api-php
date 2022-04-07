import {createContext, useState, useEffect} from 'react';
import {useRouter} from 'next/router';

const BonApiContext = createContext({});

const Provider = ({children}) => {
    const [error, setError] = useState(false);
    const [loading, setLoading] = useState(true);
    const [plats, setPlats] = useState([]);
    const [reservations, setReservations] = useState([]);
    const [commandes, setCommandes] = useState([]);
    const [tables, setTables] = useState([]);
    const [connexion,setConnexion] = useState(false);
    const router = useRouter();

    const connexionSet = (val) => {
        setConnexion(val)
    }
    
    useEffect(() => {
        const fetchPlats = async () => {
            try{
                const res = await fetch("http://localhost:8000/api/v0/plat");
                const data = await res.json();
                if(!localStorage.getItem(`panier`)){
                    localStorage.setItem(`panier`, "[]");
                }
                setPlats(data);
                setLoading(false);
            }catch(err){
                setPlats([]);
                setLoading(false);
            }
        }
        fetchPlats();
    }, [])
    
    // useEffect(() => {
    //     if(router.pathname === "/"){
    //         const fetchPlats = async () => {
    //             try{
    //                 const res = await fetch("http://localhost:8000/api/v0/plat");
    //                 const data = await res.json();
    //                 setPlats(data);
    //                 setLoading(false);
    //             }catch(err){
    //                 setError(true);
    //             }
    //         }
    //         fetchPlats();
    //     }
    //     if(router.pathname.startsWith("/admin/")){
    //         // redirect unnconnected user
    //         switch(router.pathname){
    //             case "/admin/commande":
    //                 const fetchCommandes = async () => {
    //                     try{
    //                         const res = await fetch("http://localhost:8000/api/v0/commande");
    //                         const data = await res.json();
    //                         setCommandes(data);
    //                         setLoading(false);
    //                     }catch(err){
    //                         setError(true);
    //                     }
    //                 }
    //                 fetchCommandes();
    //                 break;
    //             case "/admin/table":
    //                 const fetchTables = async () => {
    //                     try{
    //                         const res = await fetch("http://localhost:8000/api/v0/table");
    //                         const data = await res.json();
    //                         setTables(data);
    //                         setLoading(false);
    //                     }catch(err){
    //                         setError(true);
    //                     }
    //                 }
    //                 fetchTables();
    //                 break;
    //             default:
    //                 const fetchReservations = async () => {
    //                     try{
    //                         const res = await fetch("http://localhost:8000/api/v0/reservation");
    //                         const data = await res.json();
    //                         setReservations(data);
    //                         setLoading(false);
    //                     }catch(err){
    //                         setError(true);
    //                     }
    //                 }
    //                 fetchReservations();
    //                 break;
    //         }
    //     }
    // }, [router])
    
    // const handleChange = (e) => {
    //     setSearch(e.target[0].value);
    // }
    
    // const onSubmit = (ev) => {
    //     ev.preventDefault();
    //     const value = ev.target[0].value;
    //     const results = pokemons.filter((e) => e.name.includes(value)); 
    //     const display = (value === "") ? pokemons : results; 
    //     setDisplay(display);
    // }

    if(error){
        return "error";
    }
    if(loading){
        return "loading...";
    }
    return <BonApiContext.Provider value={{plats, reservations, commandes, tables,connexion,connexionSet}}>{children}</BonApiContext.Provider>;
}

export default BonApiContext;
export {Provider};