<!-- Tasks CRUD using VUE and INERTIA -->
<!-- Includes table, add modal, edit moda, delete dialog -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import {useForm,  Head } from "@inertiajs/vue3";
import SingleTableHeader from '@/Components/SingleTableHeader.vue';
import SingleTable from '@/Components/SingleTable.vue';
import Modal from '@/Components/Modal.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

// Props from backend
const props = defineProps({
    tasks: { type: Array },
});

// Add Modal Config
const isAddOpen = ref(false)
const titleInput = ref(null)

const openAdd = async () => {
    isAddOpen.value = true
    titleInput.value?.focus()
}

const closeAdd = () => {
    isAddOpen.value = false
    form.reset()
    form.clearErrors()
}

const form = useForm({
    title: '',
})

const submit = () => {
    form.post(route('tasks.store'), {
        onSuccess: () => {
            closeAdd()
        },
    })
}

// Edit Modal Config
const isEditOpen = ref(false)
const editTitleInput = ref(null)
const editForm = useForm({
    id: null,
    title: '',
})


const openEdit = async (task) => {
    editForm.reset()
    editForm.clearErrors()
    editForm.id = task.id
    editForm.title = task.title
    isEditOpen.value = true
    editTitleInput.value?.focus()
}

const closeEdit = () => {
    isEditOpen.value = false
    editForm.reset()
    editForm.clearErrors()
}

const submitEdit = () => {
    editForm.patch(route('tasks.update', editForm.id), {
        preserveScroll: true,
        onSuccess: () => {
            closeEdit()
        },
    })
}


// Delete Modal Config
const isDeleteOpen = ref(false)
const taskToDelete = ref(null)

const deleteForm = useForm({})

const confirmDelete = (task) => {
    taskToDelete.value = task
    isDeleteOpen.value = true
}

const cancelDelete = () => {
    isDeleteOpen.value = false
    taskToDelete.value = null
    deleteForm.clearErrors()
}

const doDelete = () => {
    if (!taskToDelete.value) return

    deleteForm.delete(route('tasks.destroy', taskToDelete.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            cancelDelete()
        },
    })
}
</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Tasks
            </h2>

        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- Content -->
                        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div class="flex space-x-4 justify-between items-center px-4">
                                <div>
                                    <h1 class="text-white text-4xl my-4">Tasks</h1>

                                </div>
                                <div>

                                    <button type="button" @click="openAdd"
                                            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4 mr-2 -ml-1"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h10M4 12h7M4 18h10"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 8v4m-2-2h4"/>
                                        </svg>
                                        Add Task
                                    </button>
                                </div>
                            </div>

                            <SingleTableHeader>
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Title</th>
                                        <th scope="col" class="px-4 py-3">Priority</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(task, index) in tasks" :key="task.id" class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">{{ task.title }}</td>
                                        <td class="px-4 py-3">{{ task.priority }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button @click="openEdit(task)" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 dark:hover:text-gray-900 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <button @click="confirmDelete(task)" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 dark:hover:text-gray-900 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </SingleTableHeader>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <!-- Add modal -->
    <Modal :show="isAddOpen" @close="closeAdd">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Task
                </h3>
                <button @click="closeAdd" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form @submit.prevent="submit">
                <div class="grid gap-4 mb-4">
                    <div>
                        <InputLabel for="title" value="Title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"/>
                        <TextInput id="title" v-model="form.title" type="text" required placeholder="Add a great task title" autocomplete="new-task"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"/>
                        <InputError class="mt-2" :message="form.errors.title" />
                        <!-- <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required=""> -->
                    </div>
                </div>
                <button :disabled="form.processing" @click="submit()" type="submit" :class="{'cursor-not-allowed opacity-50':form.processing}" class="text-white inline-flex items-center bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg v-show="!form.processing" class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    <svg v-if="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    <p class="text-white">
                        {{ form.processing ? 'Saving' : 'Save Task' }}
                    </p>
                </button>
            </form>
        </div>
    </Modal>

    <!-- Edit Modal -->
    <Modal :show="isEditOpen" @close="closeEdit">
        <div class="p-4 sm:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar tarea</h3>
                <button @click="closeEdit" class="text-gray-400 hover:text-gray-700 dark:hover:text-white">
                    ✕
                </button>
            </div>

            <form @submit.prevent="submitEdit">
                <label for="edit-title" class="block text-sm mb-1 text-gray-700 dark:text-gray-200">Title</label>
                <input
                    id="edit-title"
                    ref="editTitleInput"
                    v-model="editForm.title"
                    type="text"
                    class="w-full rounded border p-2 bg-white dark:bg-gray-700 dark:text-white"
                    autocomplete="off"
                />
                <div v-if="editForm.errors.title" class="text-red-500 text-sm mt-1">
                    {{ editForm.errors.title }}
                </div>
                <div class="mt-6 flex gap-2">
                    <button type="button" class="text-white px-4 py-2 rounded border" @click="closeEdit">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        :disabled="editForm.processing"
                        :class="{ 'opacity-50 cursor-not-allowed': editForm.processing }"
                        class="px-4 py-2 rounded bg-blue-600 text-white inline-flex items-center"
                    >
                        <svg v-if="editForm.processing" class="w-4 h-4 mr-2 animate-spin" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" opacity=".25"/>
                            <path d="M22 12a10 10 0 0 1-10 10" stroke="currentColor"/>
                        </svg>
                        {{ editForm.processing ? 'Updating…' : 'Update' }}
                    </button>
                </div>
            </form>
        </div>
    </Modal>



    <!-- Delete Dialog -->
    <DialogModal :show="isDeleteOpen" @close="cancelDelete">
        <template #title>Confirmar eliminación</template>
        <template #content>
            ¿Eliminar la tarea <b>{{ taskToDelete?.title }}</b>?
        </template>
        <template #footer>
            <button class="px-3 py-2 text-white border rounded mr-2" @click="cancelDelete">
                Cancel
            </button>
            <button
                class="px-3 py-2 rounded bg-red-600 text-white"
                :disabled="deleteForm.processing"
                :class="{ 'opacity-50 cursor-not-allowed': deleteForm.processing }"
                @click="doDelete"
            >
                <svg v-if="deleteForm.processing" class="w-4 h-4 mr-2 inline-block animate-spin" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" opacity=".25"/>
                    <path d="M22 12a10 10 0 0 1-10 10" stroke="currentColor"/>
                </svg>
                <p class="text-white">
                    {{ deleteForm.processing ? 'Deleting…' : 'Delete' }}
                </p>
            </button>
        </template>
    </DialogModal>
</template>
