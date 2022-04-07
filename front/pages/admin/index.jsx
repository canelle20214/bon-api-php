import {AdminHeader, Connexion, Inscription} from '../../components';
import { useContext } from 'react'
import BonApiContext from '../../contexts/BonApiContext';

const Admin = () => {
  const {connexion} = useContext(BonApiContext)
  return <>
    {connexion?<div><AdminHeader/> <Inscription/></div>:<Connexion/>}
  </>
}

export default Admin;
