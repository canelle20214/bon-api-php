const admin = {
    
    verif: async (mail,password)=>{
 
     const res = await fetch("http://localhost:8000/api/v0/admin/login",
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
     },
     post: async (nom,mail,password)=>{
    console.log("cookies",document.cookie)
    console.log("token storage",localStorage.getItem('token'))
 
     const res = await fetch("http://localhost:8000/api/v0/admin",
     {
         method: "POST",
         credentials: "same-origin",
         body: `mail=${mail}&password=${password}&nom=${nom}`,
         headers: 
         {
             "Content-Type": "application/x-www-form-urlencoded",
             'Cookie': 'token='+localStorage.getItem('token')
            //  'Content-Type': 'application/json',
            //  'Authorization': 'Basic '+btoa(localStorage.getItem('token')),
            //  'Authorization': 'Bearer '+localStorage.getItem('token')
         }
     
     })
     const data = await res.json();
     console.log("admin",data)
     return data
     }
 }
 
 export default admin