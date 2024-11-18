import { create } from 'zustand';

type Role = 'admin' | 'user';

interface User {
  id: string;
  username: string;
  role: Role;
  email: string;
}

interface AuthState {
  user: User | null;
  login: (username: string, password: string) => Promise<void>;
  logout: () => void;
}

// Mock users for demo
const MOCK_USERS = [
  { id: '1', username: 'admin', password: 'admin123', role: 'admin' as Role, email: 'admin@example.com' },
  { id: '2', username: 'user', password: 'user123', role: 'user' as Role, email: 'user@example.com' },
];

export const useAuth = create<AuthState>((set) => ({
  user: null,
  login: async (username: string, password: string) => {
    const user = MOCK_USERS.find(
      (u) => u.username === username && u.password === password
    );
    
    if (!user) {
      throw new Error('Invalid credentials');
    }
    
    const { password: _, ...userWithoutPassword } = user;
    set({ user: userWithoutPassword });
  },
  logout: () => set({ user: null }),
}));