import { create } from "zustand";
import { persist } from "zustand/middleware";

const UseUserStore = create(
  persist(
    (set, get) => ({
      user: null,
      setUser: (userData) => set({ user: { ...userData } }),
      isLoggedIn: () => !!get().user,
      clearUser: () =>
        set({
          user: {
            nome: "",
            email: "",
            senha: "",
            tipo: "",
          },
        }),
    }),
    {
      name: "user-storage", // nome da chave no localStorage
    }
  )
);

export default UseUserStore;
