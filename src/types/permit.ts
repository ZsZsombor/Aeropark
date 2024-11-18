export interface Permit {
  id: string;
  userId: string;
  type: 'access_card' | 'annual_permit';
  status: 'pending' | 'approved' | 'rejected';
  expiryDate: Date;
  documents: Document[];
}

export interface Document {
  id: string;
  name: string;
  type: string;
  url: string;
  uploadedAt: Date;
}

export interface User {
  id: string;
  username: string;
  role: 'admin' | 'user';
  email: string;
}