<template>
    <div>
        <div class="mb-2">
            <label for="name" class="form-label">Product Title</label>
            <input
                type="text"
                placeholder="Enter Product Title"
                class="form-control"
                id="producttitle"
                v-model="item.producttitle"
            >
        </div>
        <div class="mb-2">
            <label for="pro" class="form-label">Description</label>
            <input
                type="text"
                placeholder="Enter Product Description"
                class="form-control"
                id="productdescription"
                v-model="item.productdescription"
            >
        </div>
        <div class="mb-2">
                    <label for="pro" class="form-label">Price</label>
                    <input
                        type="number"
                        placeholder="Enter Product Price"
                        class="form-control"
                        id="productprice"
                        v-model="item.productprice"
                    >
        </div>
        <div class="d-grid">
            <button class="btn btn-success"
                    @click="save"
            >
                {{ isEditing ? "Update" : "Save" }}
            </button>
        </div>

        <div>
            <h3 class="text-center" v-if="lists.length > 0">All Products</h3>
            <table border="1" width="100%" class="table table-dark">
                <tr>
                    <th> Product Name </th>
                    <th> Product Description </th>
                    <th> Product Price </th>
                    <th> Action </th>
                </tr>

                <tr v-for="pro in lists" :key="pro.id">
                    <td> {{ pro.producttitle }} </td>
                    <td> {{ pro.productdescription }} </td>
                    <td> {{ pro.productprice }} </td>
                    <td> <span class="float-right">
                        <button
                            class="btn btn-warning btn-sm mr-2"
                            @click="editPro(pro)"
                        >Edit</button>
                        <button
                            class="btn btn-danger btn-sm mr-2"
                            @click="deletePro(pro.id)"
                        >Delete</button>
                    </span> </td>
                </tr>

            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Directory",
    data() {
        return {
            lists: [],
            item: {
                producttitle: "",
                productdescription: "",
                productprice: ""
            },
            isEditing: false,
            temp_id: null
        }
    },
    mounted() {
        this.fetchAll()
    },
    methods: {
        fetchAll() {
            try {
                axios.get('/api/pro')
                    .then(res => this.lists = res.data)
            } catch (e) {
                console.log(e)
            }
        },

        save() {
            let method = axios.post
            let url = "/api/pro"
            if (this.temp_id) {
                method = axios.put
                url = `/api/pro/${this.temp_id}`
            }
            try {
                method(url, this.item)
                    .then(res => {
                        this.fetchAll()
                        this.item = {
                            producttitle: "",
                            productdescription: "",
                            productprice: ""
                        }
                        this.temp_id = null
                        this.isEditing = false
                    })
            } catch (e) {
                console.log(e)
            }
        },

        editPro(pro) {
            this.item = {
                producttitle: pro.producttitle,
                productdescription: pro.productdescription,
                productprice: pro.productprice,
            }
            this.temp_id = pro.id;
            this.isEditing = true
        },


        deletePro(id) {
            try {
                axios.delete(`/api/pro/${id}`)
                    .then(res => {
                        this.fetchAll()
                    })
            } catch (e) {
                console.log(e)
            }
        }
    }
}
</script>

<style scoped>

</style>
