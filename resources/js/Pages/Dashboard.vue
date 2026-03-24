<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted }  from 'vue'
import axios from 'axios'

const tasks = ref([])
const title = ref('')

const getTasks = async () => {
    const res = await axios.get('/tasks')
    tasks.value = res.data
}

const addTask = async () => {
    if (!title.value)
        return
    await axios.post('/tasks', {
        title: title.value
    })

    title.value=''
    getTasks()
}

const toggleTask = async (task) => {
    await axios.put(`/tasks/${task.id}`, {
        is_completed: !task.is_completed,
        title: task.title
    })
    getTasks()
}

const deleteTask = async (id) => {
    await axios.delete(`/tasks/${id}`)
    getTasks()
}

onMounted(getTasks)
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <h1 class="text-2xl font-bold mb-4">📝 My Tasks</h1>

                        <div class="flex gap-2 mb-4">
                            <input
                                v-model="title"
                                placeholder="New Task"
                                class="border p-2 rounded w-full"
                            />
                            
                            <button
                                @click="addTask"
                                class="bg-blue-500 text-white px-4 rounded"
                            >

                            Add
                            </button>
                        </div>

                        <ul>
                            <li
                                v-for="task in tasks"
                                :key="task.id"
                                class="border p-2 mb-2 rounded"
                            >

                            <div>
                                <input
                                    type="checkbox"
                                    :checked="task.is_completed"
                                    @change="toggleTask(task)"
                                />



                            <span
                                :class="{ 'line-through text-gray-400': task.is_completed}"
                            >
                                {{ task.title }}
                            </span>

                            <button
                                @click="deleteTask(task.id)"
                                class="bg-red-500 text-white px-2 py-1 rounded"
                            >
                                Delete
                            </button>
                            </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
