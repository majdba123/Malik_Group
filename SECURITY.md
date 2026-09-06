# Security Policy

Please report suspected vulnerabilities privately to **majdbayer77@gmail.com**.

Do not open public issues containing credentials, private keys, personal data, exploit payloads, or live infrastructure details before remediation.

Production credentials must remain in environment configuration or provider-managed secret stores and must never be committed. Any credential that has ever entered Git history should be rotated/revoked at the provider.

Priority reports include authentication/authorization bypass, administrative privilege issues, unsafe uploads, injection, sensitive-data leakage, and deployment/configuration weaknesses.

Security fixes target the current default branch and maintained deployment path.
