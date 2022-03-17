<template>
    <div>
        <h1 class="text-center">Libros En Biblioteca</h1>
        <hr>
        <div class="card">
            <div class="card-body">
                <button @click="editar = false; abrirModal();" type="button" class="btn btn-primary" >
                Libros
            </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal" :class="{show:modal}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{tituloModal}}</h5>
                        <button @click="cerrarModal();" type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    <div class="">
                        <label for="">Nombre Libro</label>
                        <input v-model="libro.nombreLi" type="text" id="nombreLi" name="nombreLi" class="form-control">
                        
                    </div>
                    <div class="">
                        <label for="">Autor</label>
                        <input v-model="libro.autorLi" type="text" id="autorLi" name="autorLi" class="form-control">
                    </div>
                    <div class="">
                        <label for="">Status Libro</label>
                        <select v-model="libro.statusLi" name="statusLi" id="statusLi" class="form-control">
                            <option value="Disponible">Disponible</option>
                            <option value="Ocupado">Ocupado</option>
                        </select>
                        <input v-model="libro.user_id" type="hidden" id="nombreLi" name="nombreLi" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button @click="guardar();" type="button" class="btn btn-success">Guardar Cambios</button>
                </div>
                </div>
            </div>
        </div>

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
                            <th scope="col">ID Edicion</th>
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
                                <th>{{libro.user_id}}</th>
                                <td>
                                    <button @click="editar = true; abrirModal(libro);" class="btn btn-primary" >Editar</button>
                                    <button @click="eliminar(libro.id);" class="btn btn-danger" >Eliminar</button>
                                </td>
                                </tr>
                        </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Libros En Prestamo</h1>
                <hr>
            </div>
            <div class="card-">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre Libro</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Fecha Prestamo</th>
                            <th scope="col">Status Prestamo</th>
                            
                            
                        </tr>
                    </thead>
                        <tbody>
                            <tr v-for="libropres in libroprestado" :key="libropres.id">
                                <th>{{libropres.id}}</th>
                                <th>{{libropres.nombreLi}}</th>
                                <th>{{libropres.autorLi}}</th>
                                <th>{{libropres.fechap}}</th>
                                <th v-if="libropres.statusLi == 'Disponible'">
                                    <span class="badge badge-success">{{libropres.statusLi}}</span>
                                </th>
                                <th v-else>
                                    <span class="badge badge-danger">{{libropres.statusLi}}</span>
                                </th>
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
            libro : {
                nombreLi : '',
                autorLi : '',
                statusLi : '',
                user_id : 0
            },
            tituloModal : '',        
            modal: 0,
            tituloModal : '',
            editar: true,
            id : 0 ,
            libroprestado : [],
            }
    },
    methods:{
        async listar(){
            const res = await axios.get('/admin/libro/');
            this.libros = res.data;
        },
        async eliminar(id){
            const res = await axios.delete('/admin/libro/' + id);
            this.listar();
        },
        abrirModal(data = {} ){
            this.modal = 1;
            if (this.editar) {
                this.tituloModal = "Modificar Libro";
                this.id = data.id;
                this.libro.nombreLi = data.nombreLi;
                this.libro.autorLi = data.autorLi;
                this.libro.statusLi = data.statusLi;
                this.libro.user_id = this.idsesion;
                
                // console.log(this.id);
            } else {
                this.tituloModal = "Ingresar Libro";
                this.id = 0;
                this.libro.nombreLi = '';
                this.libro.autorLi = '';
                this.libro.statusLi = '';
                this.libro.user_id = this.idsesion;
                // console.log(this.libro.iduser);
            }
        },
        cerrarModal(){
            this.modal = 0;
        },
        async guardar(){
            if (this.editar) {
                const resp = await axios.put('/admin/libro/' +  this.id , this.libro);
            } else {
                const resp = await axios.post('/admin/libro/' , this.libro);
                console.log(resp);
            }
            this.cerrarModal();
            this.listar();
        },
        async libroPrestado(){
            const res = await axios.get('/admin/libroprestado/');
            this.libroprestado = res.data;
        }
    },
    created(){
        this.listar();
        this.libroPrestado();
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