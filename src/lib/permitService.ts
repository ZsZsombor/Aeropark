import { mockPermits, mockUsers } from "./mockData";
import { Permit, Document } from "@/types/permit";

export const permitService = {
  getPermits: async () => {
    return mockPermits;
  },

  getPermitById: async (id: string) => {
    return mockPermits.find((permit) => permit.id === id);
  },

  updatePermitStatus: async (id: string, status: Permit['status']) => {
    const permit = mockPermits.find((p) => p.id === id);
    if (permit) {
      permit.status = status;
    }
    return permit;
  },

  uploadDocument: async (permitId: string, file: File): Promise<Document> => {
    const newDoc: Document = {
      id: Math.random().toString(),
      name: file.name,
      type: file.type,
      url: URL.createObjectURL(file),
      uploadedAt: new Date(),
    };
    
    const permit = mockPermits.find((p) => p.id === permitId);
    if (permit) {
      permit.documents.push(newDoc);
    }
    
    return newDoc;
  },
};