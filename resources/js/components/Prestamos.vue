<template>
    <div>
        <h1 class="text-center">Libros Disponibles</h1>
        <hr>

    <!-- {{this.idsesion}} -->
        <div class="card">
            <div class="card-body">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre Libro</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Status</th>
                            
                            <th scope="col" colspan="2" class="text-center">Accion</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr v-for="libro in libros" :key="libro.id">
                                <th>{{libro.id}}</th>
                                <th>{{libro.nombreLi}}</th>
                                <th>{{libro.autorLi}}</th>
                                <th v-if="libro.statusLi == 'Disponible'">
                                    <span class="badge badge-success">{{libro.statusLi}}</span>
                                </th>
                                <th v-else>
                                    <span class="badge badge-danger">{{libro.statusLi}}</span>
                                </th>
                                <td v-if="libro.statusLi == 'Disponible'">
                                    <button @click="pedirLibro(libro);" class="btn btn-primary" >Pedir Prestado</button>
                                </td>
                                <td v-else>
                                    <button  class="btn btn-secondary" disabled>Inhabilitado</button>
                                </td>
                                </tr>
                        </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Libros que Solicite!</h1>
                <hr>
            </div>
            <div class="card-body">
                    <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre Libro</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Fecha Prestamo</th>
                            <th scope="col">Fecha Devolucion</th>
                            <th scope="col">Status Prestamo</th>
                            
                            <th scope="col" class="text-center">Accion</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr v-for="prestamo in prestamos" :key="prestamo.id">
                                <th>{{prestamo.id}}</th>
                                <th>{{prestamo.nombreLi}}</th>
                                <th>{{prestamo.autorLi}}</th>
                                <th>{{prestamo.fechap}}</th>
                                <th v-if="!prestamo.fechad == 'null'">{{prestamo.fechad}}</th>
                                <th v-else>No Devuelto</th>
                                <th v-if="prestamo.statusprestamo == 'En Posesion'">
                                    <span class="badge badge-danger">{{prestamo.statusprestamo}}</span>
                                </th>
                                <th v-else>
                                    <span class="badge badge-success">Devuelto</span>
                                </th>
                                <td v-if="prestamo.statusprestamo == 'En Posesion'">
                                    <button @click="regresarLibro(prestamo);" class="btn btn-warning" >Regresar Libro</button>
                                </td>
                            </tr>
                        </tbody>
                </table>
                </div>
        </div>

    </div>



</template>

<script>
export default {
    props: ['idsesion'],
    data() {
        return {
            libros: [],
            prestamo : {
                id: '',
                fechap : '',
                fechad : '',
                statusprestamo: '',
                user_id : 0,
                libro_id: 0,
            },
            id : 0 ,
            prestamos :[],

            }
    },
    methods:{
        async listar(){
            const res = await axios.get('/admin/libro/');
            this.libros = res.data;
        },
        async pedirLibro(data = {} ){
                let fecha = new Date();
                let fechaSave = (fecha.getFullYear() + "-" + (fecha.getMonth() +1) + "-" +  fecha.getDate());
                // console.log(fechaSave);
                this.prestamo.fechap = fechaSave;
                this.prestamo.fechad = null;
                this.prestamo.statusprestamo = 'En Posesion';
                this.prestamo.user_id = this.idsesion;
                this.prestamo.libro_id = data.id;

                const resp = await axios.post('/admin/prestamo/' , this.prestamo);
                this.listar();
                this.listarPrestamos();
                // console.log(this.id);
        },
        async listarPrestamos(){
            const res = await axios.get('/admin/prestamo/');
            this.prestamos = res.data;
            
        },
        async regresarLibro(data = {} ){
                let fecha = new Date();
                let fechaReg = (fecha.getFullYear() + "-" + (fecha.getMonth() +1) + "-" +  fecha.getDate());
                this.prestamo.fechap = data.fechap;
                this.prestamo.fechad = fechaReg;
                this.prestamo.statusprestamo = 'Devuelto';
                this.prestamo.user_id = this.idsesion;
                this.prestamo.libro_id = data.libro_id;
                this.prestamo.id = data.id;
                // console.log(this.prestamo.libro_id);
                // console.log(this.prestamo.fechap);
                
                const resp = await axios.put('/admin/prestamo/' +  this.prestamo.id , this.prestamo);
                const del = await axios.delete('/admin/prestamo/' + this.prestamo.id);
                
                this.listar();
                this.listarPrestamos();
        }
    },
    created(){
        this.listar();
        this.listarPrestamos();
        
    }
}
</script>

<style>
    .show {
        display: list-item;
        opacity: 1;
        background: gray;
    }
</style>