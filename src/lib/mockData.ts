import { Permit, Document, User } from "@/types/permit";

export const mockPermits: Permit[] = [
  {
    id: "1",
    userId: "1",
    type: "access_card",
    status: "pending",
    expiryDate: new Date(2024, 11, 31),
    documents: [
      {
        id: "1",
        name: "Resume.pdf",
        type: "application/pdf",
        url: "/mock-files/resume.pdf",
        uploadedAt: new Date(),
      },
    ],
  },
  {
    id: "2",
    userId: "2",
    type: "annual_permit",
    status: "approved",
    expiryDate: new Date(2024, 5, 30),
    documents: [],
  },
];

export const mockUsers: User[] = [
  {
    id: "1",
    username: "admin",
    role: "admin",
    email: "admin@example.com",
  },
  {
    id: "2",
    username: "user",
    role: "user",
    email: "user@example.com",
  },
];