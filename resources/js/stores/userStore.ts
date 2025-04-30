import { defineStore } from 'pinia';
import axios from 'axios';
import { PaginatedMeta } from './models/PaginatedMeta';
import { PaginatedLinks } from './models/PaginatedLinks';

interface State {
  usersPaginated: UsersPaginated
  users: User[]
  user: User | null
  isLoading: boolean
  error: string | null
}

interface UsersPaginated {
  items: User[]
  meta: PaginatedMeta | null
  links: PaginatedLinks | null
}

interface User {
  id: number
  firstName: string
  lastName: string
  email: string
  status: string
}

export const useUserStore = defineStore('user', {
  state: (): State => {
    return {
      usersPaginated: {
        items: [],
        meta: null,
        links: null,
      },
      users: [],
      user: null,
      isLoading: false,
      error: null
    }
  },
  getters: {
    getUserById: (state: State) => {
      return (userId: number) => state.users.find((user) => user.id === userId);
    },
    getUsers: (state: State) => {
      return state.users;
    },
    getUsersPaginated: (state: State) => {
      return state.usersPaginated;
    },
  },
  actions: {
    async fetchUsers(page?: number, perPage?: number, search?: string) {
      this.isLoading = true;
      try {
        const response = await axios.get('http://localhost:8000/api/users', {params: {page, perPage, search}});
        this.usersPaginated = {
          items: response.data.items,
          meta: response.data.meta,
          links: response.data.links,
        }
        this.users = response.data.items;
      } catch (error) {
        this.error = error.message;
        console.error(this.error);
      } finally {
        this.isLoading = false;
      }
    }
  }
})