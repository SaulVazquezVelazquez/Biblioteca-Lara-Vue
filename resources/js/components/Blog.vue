<template>
    <div>
        <h1 class="text-center">Blog Desde un componente</h1>
        <hr>
        <div class="card">
            <div class="card-body">
                <button @click="editar = false; abrirModal();" type="button" class="btn btn-primary" >
                Blogs
            </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal" :class="{show:modal}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{tituloModal}}</h5>
                        <button @click="cerrarModal();" class="btn-close" ></button>
                    </div>
                <div class="modal-body">
                    <div class="">
                        <label for="">Titulo</label>
                        <input v-model="blog.titulo" type="text" id="titulo" name="titulo" class="form-control">
                    </div>
                    <div class="">
                        <label for="">Contenido</label>
                        <textarea v-model="blog.contenido" name="contenido" id="contenido" cols="2" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button @click="guardar();" type="button" class="btn btn-success">Guardar Cambios</button>
                </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Contenido</th>
                            <th scope="col" colspan="2" class="text-center">Accion</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr v-for="blog in blogs" :key="blog.id">
                                <th>{{blog.id}}</th>
                                <th>{{blog.titulo}}</th>
                                <th>{{blog.contenido}}</th>
                                <td>
                                    <button @click="editar = true; abrirModal(blog);" class="btn btn-primary" >Editar</button>
                                    <button @click="eliminar(blog.id);" class="btn btn-danger" >Eliminar</button>
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
    data() {
        return {
            blogs: [],
            blog : {
                titulo : '',
                contenido : '',
                
            },
            tituloModal : '',        
            modal: 0,
            tituloModal : '',
            editar: true,
            id : 0 ,
            }
    },
    methods:{
        async listar(){
            const res = await axios.get('/blog/');
            this.blogs = res.data;
            console.log(this.blogs);
        },
        async eliminar(id){
            const res = await axios.delete('/blog/' + id);
            this.listar();
        },
        abrirModal(data = {} ){
            this.modal = 1;
            if (this.editar) {
                this.tituloModal = "Modificar Blog";
                this.blog.titulo = data.titulo;
                this.blog.contenido = data.contenido;
                this.id = data.id;
            } else {
                this.tituloModal = "Crear Blog";
                this.blog.titulo = '';
                this.blog.contenido = '';
                this.id = 0;
            }
        },
        cerrarModal(){
            this.modal = 0;
        },
        async guardar(){
            if (this.editar) {
                const resp = await axios.put('/blog/' + this.id , this.blog);
            } else {
                const res = await axios.post('/blog/' , this.blog);
            }
            this.cerrarModal();
            this.listar();
        },
        
    },
    created(){
        this.listar();
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