export type Users = {
    name: string;
    email?: string;
    course_offer?: string;
    created_at?: string;
    role?: string;
};

export const usersAsync = <T = Users>() => {
    
    const fetchUsers = async <T = Users>() => {
        try {
          return await $larafetch<T>("/api/users");
        } catch (error: any) {
          if ([401, 419].includes(error?.response?.status)) return null;
          throw error;
        }
    };

    return {
        fetchUsers
    };

}