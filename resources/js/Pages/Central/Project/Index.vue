<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Notification from '@/Components/Notification.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';


export default {
    props: {
        tenants: Array
    },
    components: {
        AuthenticatedLayout,
        Head,
        InputLabel,
        TextInput,
        Notification,
        Head,
        Link
    },
    data() {
        return {
            modalCreateProject: false,
            name: 'rizki',
            form: {
                tenant: '',
                domain: '',
            },
        }

    },
    methods: {
        closeModal(event) {
            this.modalCreateProject = false
            this.form.tenant = ''
            this.form.domain = ''
        },
        openModal(event) {
            this.modalCreateProject = true
        },
        createTenant() {
            Inertia.post(route('tenant.store'), this.form)
            this.closeModal()
        },


    },
}
</script>

<template>

    <Head title="Project" />
    <AuthenticatedLayout :is-central="$page.props.isCentral">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Project</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                <div v-if="$page.props.flash.message">
                    <Notification :message="$page.props.flash.message" />
                </div>

                <!-- The button to open modal -->
                <label @click="openModal" class="btn mt-3">Create Project</label>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="create-project" class="modal-toggle" />
                <div class="modal modal-bottom sm:modal-middle"
                    :class="{ 'modal-open': modalCreateProject, '': !modalCreateProject }">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg mb-5">Create new project</h3>
                        <form @submit.prevent="createTenant">

                            <InputLabel for="name_project" value="Name Project" />
                            <TextInput id="name_project" v-model="form.tenant" type="text" class="mt-1 block w-full" />
                            <br>
                            <InputLabel for="subdomain" value="Name Domain" />
                            <TextInput id="subdomain" type="text" v-model="form.domain" class="mt-1 block w-full" />

                            <div class="modal-action">
                                <label @click="closeModal" class="btn">Not now</label>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-10">
                    <div class="p-6 text-gray-900">Let's create your first project!</div>
                </div>

                <!--  Table data -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Database</th>
                                    <th>Domain</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr v-for="tenant in tenants " :key="tenant.id">
                                    <td>{{ tenant.id }}</td>
                                    <td>
                                        {{ tenant.tenancy_db_name }}
                                    </td>
                                    <td>
                                        {{ tenant.domains[0].domain }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-error mr-3 text-white">Delete</button>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
