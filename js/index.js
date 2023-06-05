var app = new Vue ({
    el:'#app',
    data:
    {
        url:'https://cbtis169.net/apiServer/usuarios',
        usuarios:[],
        id:0,
        nombre:'',
        usuario:'',
        clave:'',
    },
    mounted(){
        console.log("Ejecutando mounted");
        this.verUsuarios();
    },
   methods:{
        verUsuarios: async function()
        {
                await axios.get(this.url).then((response) =>{
                const results = response.data;
                this.usuarios=results.usuarios;
                console.log(this.usuarios);
                console.log("verUsuarios ejecutado");
            });
            
        }
    }
})