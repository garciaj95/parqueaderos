<template>
    <div>
        <h2 class="text-center">Listado de Marcas</h2>
 
        <div class="col-md-12 text-right">
            <router-link :to="{name: 'marca_create'}" class="nav-item nav-link">Nueva Marca</router-link>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>
                </thead>
                <tbody v-if="verificarListado">
                    <tr v-for="marca in marcas" :key="marca.id">
                        <td>{{ marca.id }}</td>
                        <td>{{ marca.nombre }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <router-link :to="{name: 'marca_edit', params: { id: marca.id }}" class="btn btn-primary">
                                    <i class="fa fa-pencil"></i>
                                </router-link>
                                <button class="btn btn-danger" @click="deleteMarca(marca.id)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                marcas: []
            }
        },
        computed: {
            verificarListado() {
                return this.marcas.length > 0
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/marcas/')
                .then(response => {
                    this.marcas = response.data;
                });
        },
        methods: {
            deleteMarca(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/marcas/${id}`)
                    .then(response => {
                        let i = this.marcas.map(data => data.id).indexOf(id);
                        this.marcas.splice(i, 1)
                    });
            }
        }
    }
</script>