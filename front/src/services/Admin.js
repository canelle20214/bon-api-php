const admin = {
    
    verif: async (mail,password)=>{
 
     const res = await fetch("http://localhost:8000/api/v0/admin",
     {
         method: "POST",
         
         body: `mail=${mail}&password=${password}`,
         headers: 
         {
             "Content-Type": "application/x-www-form-urlencoded"
         }
     
     })
     const data = await res.json();
     console.log("admin",data)
     return data
     }
 }
 
 export default admin